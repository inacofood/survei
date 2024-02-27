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
            'category' => 'required|string',
            'subcategory' => 'required|string',
            'link' => 'required|string',
            'status' => 'required|string|in:Review,Published,Takedown',
        ]);

        // Simpan data ke dalam database
        try {
            $item = new ListLink();
            $item->title = $request->title;
            $item->category = $request->category;
            $item->sub_cat = $request->subcategory;
            $item->link = $request->link;
            $item->status = $request->status;
            $item->save();

            // Kembali ke view dengan pesan sukses
            return redirect()->back()->with('success', 'New module added successfully.');
        } catch (\Exception $e) {
            // Jika terjadi error, kembali ke view dengan pesan error
            return back()->with('error', 'Failed to Add New Module.');
        }
    }


    public function Download() {
        $file_name = "Template_Import_emodule.xlsx";
        $file_path = public_path($file_name);
        return response()->download($file_path);
      }

      public function importFromExcel(Request $request)
      {
          try {
              if ($request->hasFile('excelFile') && $request->file('excelFile')->isValid()) {
                  $excelFile = $request->file('excelFile');
                  $filePath = $excelFile->storeAs('excel', 'newInput.xlsx');

                  $reader = IOFactory::createReaderForFile($excelFile->path());
                  $spreadsheet = $reader->load($excelFile->path());
                  $worksheet = $spreadsheet->getActiveSheet();
                  $highestRow = $worksheet->getHighestDataRow();

                  for ($row = 2; $row <= $highestRow; ++$row) {
                      $category = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                      $subcategory = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                      $title = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                      $status = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                      $link = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                      // Check if row is empty
                      $rowData = [$category, $subcategory, $title, $status, $link];
                      if (array_filter($rowData)) {
                          // Manual validation
                          if (!empty($category) && !empty($subcategory) && !empty($title) && !empty($status) && !empty($link)) {
                              if (in_array($status, ['Review', 'Published', 'Takedown'])) {
                                  // Simpan data ke dalam database
                                  $item = new ListLink();
                                  $item->category = $category;
                                  $item->sub_cat = $subcategory;
                                  $item->title = $title;
                                  $item->status = $status;
                                  $item->link = $link;
                                  $item->save();
                              } else {
                                  return back()->with('error', 'Invalid status at row ' . $row);
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
              return back()->with('error', 'Failed to import data: ' . $e->getMessage());
          }
      }


}
