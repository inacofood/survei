<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListLink;
use PhpOffice\PhpSpreadsheet\IOFactory; // Masukkan ini di bagian atas class


class InputController extends Controller
{
    public function addNewModule(Request $request)
{
    // Mengambil data dari request
    $title = $request->title;
    $category = $request->category;
    $subcategory = $request->subcategory;
    $link = $request->link;
    $video = $request->video;
    $status = $request->status;

    // Memeriksa apakah semua input yang diperlukan telah disediakan
    try {
        // Membuat instance baru dari ListLink
        $item = new ListLink();

        // Mengisi properti-properti dari instance
        $item->title = $title;
        $item->category = $category;
        $item->sub_cat = $subcategory;
        $item->link = $link;
        $item->video = $video;
        $item->status = $status;
        $item->save();

        return back()->with('success', 'Data Berhasil Di Input ');
    } catch (\Exception $e) {
        // Jika terjadi error, kembali ke view dengan pesan error
        return back()->with('error', 'Data Berhasil Di Input '. $e->getMessage());
    }

}


    public function Download() {
        $file_name = "template_import_emodule.xlsx";
        $file_path = public_path($file_name);
        return response()->download($file_path);
    }

    public function importFromExcel(Request $request)
    {
        try
        {
            if ($request->hasFile('excelFile') && $request->file('excelFile')->isValid())
            {
                $excelFile = $request->file('excelFile');
                $filePath = $excelFile->storeAs('excel', 'newInput.xlsx');

                $reader = IOFactory::createReaderForFile($excelFile->path());
                $spreadsheet = $reader->load($excelFile->path());
                $worksheet = $spreadsheet->getActiveSheet();
                $highestRow = $worksheet->getHighestDataRow();

                for ($row = 2; $row <= $highestRow; ++$row)
                {
                    $category = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $subcategory = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $title = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $status = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $link = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $video = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                    // Check if row is empty
                    $rowData = [$category, $subcategory, $title, $status, $link, $video];

                    if (array_filter($rowData))
                    {
                        // Manual validation
                        if (!empty($category) && !empty($subcategory) && !empty($title) && !empty($status) && !empty($link) && !empty($video))
                        {
                            if (in_array($category, ['Hard Skills', 'Soft Skills', 'Technical Skills']))
                            {
                                if (in_array($status, ['Review', 'Published', 'Takedown']))
                                {
                                    if (is_int($video))
                                    {
                                        $item = new ListLink();
                                        $item->category = $category;
                                        $item->sub_cat = $subcategory;
                                        $item->title = $title;
                                        $item->status = $status;
                                        $item->link = $link;
                                        $item->video = $video;
                                        $item->save();
                                    } else {
                                        return back()->with('error', 'Video must be a number at row ' . $row);
                                    }
                                } else {
                                    return back()->with('error', 'Invalid status at row ' . $row);
                                }
                            } else {
                                return back()->with('error', 'Invalid category at row ' . $row);
                            }
                        } else {
                            return back()->with('error', 'Missing data at row ' . $row);
                        }
                    }
                }

                // Setelah impor selesai, arahkan pengguna ke tampilan yang sesuai
                return redirect()->back()->with('success', 'New modules added successfully.');
            } else {
                return back()->with('error', 'No valid file uploaded.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'No valid file uploaded.');
        }
    }
}

