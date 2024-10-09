<?php

namespace App\Exports;

use App\Models\Nilai_ocai;
use App\Models\Departments;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class NilaiOcaiExport implements FromCollection, WithHeadings, WithCustomStartCell, WithEvents
{
    public function collection()
    {
        return Nilai_ocai::with(['department', 'kategori'])->get()->map(function ($item) {
            $nilaiSaatIni = json_decode($item->nilai_saat_ini, true);
            $nilaiIdeal = json_decode($item->nilai_ideal, true);

            $nilaiSaatIni = is_array($nilaiSaatIni) ? $nilaiSaatIni : [null, null, null, null];
            $nilaiIdeal = is_array($nilaiIdeal) ? $nilaiIdeal : [null, null, null, null];
            $caridepart = Departments::where('id', $item->department)->first();

            return [
                'nama' => $item->nama,
                'department' => $caridepart ? $caridepart->department_name : 'Unknown',
                'kategori' => $item->kategori ? $item->kategori->nama_kategori : 'Unknown',

                'nilai_saat_ini_a' => $nilaiSaatIni[0] ?? null,
                'nilai_saat_ini_b' => $nilaiSaatIni[1] ?? null,
                'nilai_saat_ini_c' => $nilaiSaatIni[2] ?? null,
                'nilai_saat_ini_d' => $nilaiSaatIni[3] ?? null,

                'nilai_ideal_a' => $nilaiIdeal[0] ?? null,
                'nilai_ideal_b' => $nilaiIdeal[1] ?? null,
                'nilai_ideal_c' => $nilaiIdeal[2] ?? null,
                'nilai_ideal_d' => $nilaiIdeal[3] ?? null,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Departemen',
            'Kategori',
            'A', 'B', 'C', 'D', 
            'A', 'B', 'C', 'D' 
        ];
    }

    public function startCell(): string
    {
        return 'A2'; // Data dimulai dari A2
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $totalRows = Nilai_ocai::count();

                for ($i = 3; $i <= ($totalRows * 6) + 2; $i += 6) {
                    $event->sheet->getDelegate()->mergeCells("A{$i}:A" . ($i + 5)); 
                    $event->sheet->getDelegate()->mergeCells("B{$i}:B" . ($i + 5)); 

                    $event->sheet->getDelegate()->getStyle("A{$i}:A" . ($i + 5))->getAlignment()->setHorizontal('center');
                    $event->sheet->getDelegate()->getStyle("B{$i}:B" . ($i + 5))->getAlignment()->setHorizontal('center');
                    $event->sheet->getDelegate()->getStyle("A{$i}:A" . ($i + 5))->getAlignment()->setVertical('center');
                    $event->sheet->getDelegate()->getStyle("B{$i}:B" . ($i + 5))->getAlignment()->setVertical('center');
                }

                $event->sheet->getDelegate()->mergeCells('A1:A2'); 
                $event->sheet->getDelegate()->mergeCells('B1:B2'); 
                $event->sheet->getDelegate()->mergeCells('C1:C2'); 

                $event->sheet->setCellValue('A1', 'Nama');
                $event->sheet->setCellValue('B1', 'Departemen');
                $event->sheet->setCellValue('C1', 'Kategori');

                $event->sheet->getDelegate()->getStyle('A1:A2')->getAlignment()->setHorizontal('center');
                $event->sheet->getDelegate()->getStyle('B1:B2')->getAlignment()->setHorizontal('center');
                $event->sheet->getDelegate()->getStyle('C1:C2')->getAlignment()->setHorizontal('center');
                $event->sheet->getDelegate()->getStyle('A1:A2')->getAlignment()->setVertical('center');
                $event->sheet->getDelegate()->getStyle('B1:B2')->getAlignment()->setVertical('center');
                $event->sheet->getDelegate()->getStyle('C1:C2')->getAlignment()->setVertical('center');

                $event->sheet->getDelegate()->mergeCells('D1:G1');
                $event->sheet->getDelegate()->mergeCells('H1:K1');

                $event->sheet->setCellValue('D1', 'Kondisi Saat Ini');
                $event->sheet->setCellValue('H1', 'Kondisi Ideal');

                $event->sheet->getDelegate()->getStyle('D1')->getAlignment()->setHorizontal('center');
                $event->sheet->getDelegate()->getStyle('H1')->getAlignment()->setHorizontal('center');
            }
        ];
    }
}
