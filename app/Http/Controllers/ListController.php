<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ListLink;

class ListController extends Controller
{
    public function index()
    {
        $subCategories = ListLink::select('sub_cat')->distinct()->get();
        $statuses = ListLink::select('status')->distinct()->get();
        $listItems = ListLink::orderBy('id', 'asc')->get();
        return view('list.index', compact('listItems', 'subCategories','statuses'));
    }

    public function updateStatus(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|string'
        ]);

        // Ambil data dari permintaan
        $itemId = $request->id;
        $newStatus = $request->status;

        // Lakukan pembaruan status di database sesuai dengan $itemId
        $item = ListLink::find($itemId);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        $item->status = $newStatus;
        $item->save();

        // Kirim respons ke klien
        return response()->json(['message' => 'Status updated successfully']);
    }


}



