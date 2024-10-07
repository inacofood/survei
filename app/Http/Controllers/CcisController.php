<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListLink;
use App\Models\Kategori_ocai;
use App\Models\Title_ocai;
use App\Models\Nilai_ocai;
use App\Models\Departments;
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

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = Kategori_ocai::findOrFail($id);
        return response()->json($category);
    }


    public function update(Request $request, $id)
    {
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
    ]);

    try {
        $category = Kategori_ocai::findOrFail($id);
        $category->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    } catch (\Exception $e) {
        return redirect()->route('kategori.index')->with('error', 'Terjadi kesalahan saat memperbarui kategori');
    }
    }

    public function destroy($id)
    {
        $category = Kategori_ocai::findOrFail($id);
        $category->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }

    public function indextitle()
    {
    $kategori = Kategori_ocai::all();
    $title = Title_ocai::all();

    return view('title', compact('title', 'kategori'));
    }


    public function storetitle(Request $request)
    {
        $request->validate([
            'nama_title' => 'required|string|max:255',
            'id_kategori' => 'required|integer',
        ]);

        Title_ocai::create([
            'nama_title' => $request->nama_title,
            'id_kategori' => $request->id_kategori,
        ]);

        return redirect()->route('title.index')->with('success', 'Title berhasil ditambahkan!');
    }


    public function edittitle($id)
    {
        $title = Title_ocai::findOrFail($id);
        return response()->json($title);
    }


    public function updatetitle(Request $request, $id)
    {
    $request->validate([
        'nama_title' => 'required|string|max:255',
    ]);

    try {
        $title = Title_ocai::findOrFail($id);
        $title->update([
            'nama_title' => $request->nama_title,
        ]);

        return redirect()->route('title.index')->with('success', 'title berhasil diperbarui');
    } catch (\Exception $e) {
        return redirect()->route('title.index')->with('error', 'Terjadi kesalahan saat memperbarui title');
    }
    }

    public function destroytitle($id)
    {
        $title= Title_ocai::findOrFail($id);
        $title->delete();

        return redirect()->route('title.index')->with('success', 'Title berhasil dihapus');
    }

    public function ocaiindex()
    {
        $nilaiOcai = Nilai_ocai::all();
        foreach ($nilaiOcai as $nilai) {
            $nilai->nilai_saat_ini = json_decode($nilai->nilai_saat_ini, true);
            $nilai->nilai_ideal = json_decode($nilai->nilai_ideal, true);
            $caridepart = Departments::where('id',$nilai->department)->first();
            $nilai->department = $caridepart->department_name;
            $carikategori = Kategori_ocai::where('id_kategori',$nilai->id_kategori)->first();
            $nilai->id_kategori = $carikategori->nama_kategori;


        }
        // dd($nilaiOcai);
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
            return redirect()->back()->with('error', 'Data untuk nama dan department ini sudah ada dalam tahun ini.');
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

}
