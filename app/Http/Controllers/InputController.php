<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListLink;
use PhpOffice\PhpSpreadsheet\IOFactory; // Masukkan ini di bagian atas class

class InputController extends Controller
{
    public function addNewModule(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string',
            'subCategory' => 'required|string',
            'link' => 'required|string',
            'status' => 'required|string|in:Review,Published,Takedown',
        ]);

        // Simpan data ke dalam database
        $item = new ListLink();
        $item->title = $request->title;
        $item->sub_cat = $request->subCategory;
        $item->link = $request->link;
        $item->status = $request->status;
        $item->save();

        // Berikan respons JSON yang berisi data modul yang baru ditambahkan
        return response()->json($item);
    }

    public function importFromExcel(Request $request)
    {
        if ($request->hasFile('excelFile') && $request->file('excelFile')->isValid()) {
            $excelFile = $request->file('excelFile');
            $filePath = $excelFile->storeAs('excel', 'newInput.xlsx');

            $reader = IOFactory::createReaderForFile($excelFile->path());
            $spreadsheet = $reader->load($excelFile->path());
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestDataRow();

            for ($row = 2; $row <= $highestRow; ++$row) {
                // Cek jika semua kolom memiliki nilai yang valid
                if (
                    $worksheet->getCellByColumnAndRow(2, $row)->getValue() &&
                    $worksheet->getCellByColumnAndRow(3, $row)->getValue() &&
                    $worksheet->getCellByColumnAndRow(4, $row)->getValue() &&
                    $worksheet->getCellByColumnAndRow(5, $row)->getValue()
                ) {
                    $subCategory = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $title = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $status = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $link = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

                    // Simpan data ke dalam database
                    $item = new ListLink();

                    $item->sub_cat = $subCategory;
                    $item->title = $title;
                    $item->status = $status;
                    $item->link = $link;
                    $item->save();
                }
            }

            // return response()->json(['message' => 'Data imported successfully.']);
            return response()->json([
                'success' => true,
                'message' => 'Data imported successfully.',
            ]);

        }
    }
}
