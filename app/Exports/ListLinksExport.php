<?php

namespace App\Exports;

use App\Models\ListLink;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ListLinksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ListLink::all()->map(function ($item) {
            // Menghapus kolom created_at dan updated_at
            unset($item['created_at']);
            unset($item['updated_at']);
            return $item;
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Sub-category',
            'Title',
            'Status',
            'Link',
        ];
    }
}
