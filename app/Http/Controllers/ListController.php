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
        // Validasi permintaan
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'subcategory' => 'required|string',
            'link' => 'required|string',
            'status' => 'required|string|in:Review,Published,Takedown',
        ]);

        // Ambil data dari permintaan
        $itemId = $request->id;
        $newTitle = $request->title;
        $newCategory = $request->category;
        $newSubCategory = $request->subcategory;
        $newLink = $request->link;
        $newStatus = $request->status;

        // Lakukan pembaruan status di database sesuai dengan $itemId
        $item = ListLink::find($itemId);
        if (!$item) {
            return redirect()->back()->with('error', 'Item not found.');
        }
        $item->title = $newTitle;
        $item->category = $newCategory;
        $item->sub_cat = $newSubCategory;
        $item->link = $newLink;
        $item->status = $newStatus;
        $item->save();

        // Kirim respons ke klien
        return redirect()->back()->with('success', 'Data updated successfully.');


    }

    public function deleteData($id)
    {
        try {
            $item = ListLink::findOrFail($id);
            $item->delete();

            return redirect()->back()->with('success', 'Item deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete item: ' . $e->getMessage());
        }
    }


    public function export()
    {
        return Excel::download(new ListLinksExport, 'list_links.xlsx');
    }


}



