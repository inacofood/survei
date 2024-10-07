<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ListLink;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ListLinksExport;

class ListController extends Controller
{
    public function index()
    {
        $subCategories = ListLink::select('sub_cat')->distinct()->get();
        $statuses = ListLink::select('status')->distinct()->get();
        $listItems = ListLink::orderBy('id', 'desc')->get();
        return view('list.index', compact('listItems', 'subCategories','statuses'));
    }

    public function getModalData(Request $request)
    {
        $itemId = $request->input('id'); // Get ID from request
        // Find the link based on the ID
        $link = ListLink::find($itemId);

        if ($link) {
            // If link is found, return data as JSON response
            return response()->json($link);
        } else {
            // If link is not found, return response with appropriate status code
            return response()->json(['error' => 'Link not found'], 404);
        }
    }

    public function updateData(Request $request)
    {

        // Ambil data dari permintaan
        $itemId = $request->id;
        $newTitle = $request->title;
        $newCategory = $request->category;
        $newSubCategory = $request->subcategory;
        $newLink = $request->link;
        $newVideo = $request->video;
        $newStatus = $request->status;

        // Lakukan pembaruan status di database sesuai dengan $itemId
        $item = ListLink::find($itemId);
        if (!$item) {
            return back()->with('error', 'Data Tidak Ditemukan');
        }
            $item->title = $newTitle;
            $item->category = $newCategory;
            $item->sub_cat = $newSubCategory;
            $item->link = $newLink;
            $item->video = $newVideo;
            $item->status = $newStatus;
            $item->save();

            // Kirim respons ke klien
            return back()->with('success', 'Data Berhasil di Update');

    }

    public function deleteData($id)
    {
        try {
            $item = ListLink::findOrFail($id);
            $item->delete();

            return back()->with('success', 'Data Berhasil di Delete');
        } catch (\Exception $e) {
            return back()->with('error', 'Data Gagal di Delete');
        }
    }

    public function export()
    {
        return Excel::download(new ListLinksExport, 'list_links.xlsx');
    }
}
