<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListLink;
use App\Models\Kategori_ocai;
use App\Models\Title_ocai;
use App\Models\Nilai_ocai;
use App\Models\Departments;
use App\Exports\NilaiOcaiExport;
use Maatwebsite\Excel\Facades\Excel; 
use PhpOffice\PhpSpreadsheet\IOFactory;


class CcisController extends Controller{
  
    public function index(){
        $departments = Departments::all();
        return view('ccis', compact('departments'));
    }

    public function indexkategori()
    {
        $categories = Kategori_ocai::all(); 
        return view('ocai', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori_ocai::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    { 
        $category = Kategori_ocai::findOrFail($id);
        return response()->json($category);
    }
    
    public function update(Request $request, $id)
    {
        $kategori = Kategori_ocai::findOrFail($id); 
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
    
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Request $request)
    {
    
        $kategori = Kategori_ocai::findOrFail($request->id);
        $kategori->delete();

       
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }

    public function indextitle()
    {
        $kategori = Kategori_ocai::all();
        $title = Title_ocai::with('kategori')->get(); 
        
        return view('title', compact('title', 'kategori'));
    }

    public function storetitle(Request $request)
    {
        $request->validate([
            'nama_title' => 'required|string|max:255',
            'id_kategori' => 'required|integer', // Ubah id_kategori menjadi kategori_id
        ]);

        Title_ocai::create([
            'nama_title' => $request->nama_title,
            'id_kategori' => $request->id_kategori, // Ubah id_kategori menjadi kategori_id
        ]);

        return redirect()->back()->with('success', 'Item berhasil disimpan!');
    }

    
    public function edittitle($id)
    {
        $title = Title_ocai::find($id);
        if ($title) {
            return response()->json($title);
        } else {
            return response()->json(['message' => 'Title tidak ditemukan'], 404);
        }
    }
    
    public function updatetitle(Request $request)
    {
        $title = Title_ocai::findOrFail($request->id_title);
        $title->nama_title = $request->nama_title;
        $title->id_kategori = $request->id_kategori;
        $title->save();
    
        return redirect()->back()->with('success', 'Item berhasil diperbaharui!');
    }

    public function destroytitle(Request $request)
    {
    
        $title = Title_ocai::findOrFail($request->id);
        $title->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus!');
    }
    
    
    public function ocaiindex()
    {
        $nilaiOcai = Nilai_ocai::orderBy('id_nilai', 'desc')->get(); 
        foreach ($nilaiOcai as $nilai) {
            $nilai->nilai_saat_ini = json_decode($nilai->nilai_saat_ini, true);
            $nilai->nilai_ideal = json_decode($nilai->nilai_ideal, true);
            $caridepart = Departments::where('id', $nilai->department)->first();
            $nilai->department = $caridepart ? $caridepart->department_name : 'Unknown';
            $carikategori = Kategori_ocai::where('id_kategori', $nilai->id_kategori)->first();
            $nilai->id_kategori = $carikategori ? $carikategori->nama_kategori : 'Unknown';
        }
    
        return view('nilaiocai', compact('nilaiOcai'));
    }    

    public function ocaistore(Request $request)
    {
        $currentYear = date('Y');
        $existingEntry = Nilai_ocai::where('nama', $request->input('nama'))
            ->where('department', $request->input('department'))
            ->whereYear('created_at', $currentYear)
            ->first();

        if ($existingEntry) {
            return redirect()->back()->with('error', 'Data untuk nama dan departemen ini sudah ada dalam tahun ini!');
        }

        for ($idTitle = 1; $idTitle <= 6; $idTitle++) {
            $nilaiSaatIni = [];
            $nilaiIdeal = [];

            for ($i = 1; $i <= 4; $i++) {
                $nilaiSaatIni[] = $request->input("nilaisaatini" . $idTitle . $i);
                $nilaiIdeal[] = $request->input("nilaiideal" . $idTitle . $i);
            }

            Nilai_ocai::create([
                'nama' => $request->input('nama'),
                'department' => $request->input('department'),
                'id_kategori' => $idTitle,
                'nilai_saat_ini' => json_encode($nilaiSaatIni),  
                'nilai_ideal' => json_encode($nilaiIdeal),    
            ]);
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }

    public function exportocai()
    {
        return Excel::download(new NilaiOcaiExport, 'nilai_ocai.xlsx');
    }

    public function ocaidestroy(Request $request)
    {
        $nilai = Nilai_ocai::findOrFail($request->id);
        $nama = $nilai->nama;
        $department = $nilai->department;

        Nilai_ocai::where('nama', $nama)
                    ->where('department', $department)
                    ->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }


    
}