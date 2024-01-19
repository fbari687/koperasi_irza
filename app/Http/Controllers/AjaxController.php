<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    
    public function searchItem(Request $request) {
        if($request->search == "" || $request->search == " ") {
            $searchItems = Item::get();
        } else {
            $searchItems = Item::where(function($query) use ($request) {
                $query->where('nama_barang', 'LIKE', '%' . $request->search . '%')
                ->orWhere('deskripsi', 'LIKE', '%' . $request->search . '%')
                ->orWhere('harga', 'LIKE', '%' . $request->search . '%');
            })->get();
        }

        return response()->json($searchItems);

        // return view('ajax.items', [
        //     'items' => $searchItems
        // ]);
    }

    public function filterItem(Request $request) {
        if($request->filter == 'terbaru') {
            $searchItems = Item::orderBy('created_at', 'desc')->get();
        } elseif($request->filter == 'terlama') {
            $searchItems = Item::orderBy('created_at', 'asc')->get();
        } elseif($request->filter == 'termahal') {
            $searchItems = Item::orderBy('harga', 'desc')->get();
        } elseif($request->filter == 'termurah') {
            $searchItems = Item::orderBy('harga', 'asc')->get();
        } elseif($request->filter == 'tersedia') {
            $searchItems = Item::where('stok', '>', 0)->get();
        } elseif($request->filter == 'habis') {
            $searchItems = Item::where('stok', '<', 1)->get();
        } else {
            $searchItems = Item::orderBy('created_at', 'desc')->get();
        }

        return response()->json($searchItems);

        // return view('ajax.items', [
        //     'items' => $searchItems
        // ]);
    }

}
