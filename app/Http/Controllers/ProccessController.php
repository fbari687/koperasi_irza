<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProccessController extends Controller
{
    
    public function handleAddItem(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Gagal menyimpan item');

        $similar = Item::where('nama_barang', $request->nama_barang)->where('harga', $request->harga)->where('slug', Str::slug($request->nama_barang))->exists();
        if($similar) return redirect()->back()->with('error', 'Data barang ini sudah tersedia');

        $item = new Item;
        $item->nama_barang = $request->nama_barang;
        $item->slug = Str::slug($request->nama_barang);
        $item->harga = $request->harga;
        $item->stok = $request->stok;
        $item->deskripsi = $request->deskripsi;
        
        if(!$item->save()) return redirect()->back()->with('error', 'Gagal menyimpan barang');
        return redirect()->back()->with('success', 'Item berhasil disimpan');
    }

    public function handleUpdateItem(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'nama_barang' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);
        if($validator->fails()) return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Gagal menyimpan item');

        $item = Item::find($request->id);
        if(!$item) return redirect()->back()->with('error', 'Data barang ini sudah tersedia');

        $item->nama_barang = $request->nama_barang;
        $item->slug = Str::slug($request->nama_barang);
        $item->harga = $request->harga;
        $item->stok = $request->stok;
        $item->deskripsi = $request->deskripsi;
        
        if(!$item->save()) return redirect()->back()->with('error', 'Gagal menyimpan barang');
        return redirect()->back()->with('success', 'Item berhasil disimpan');
    }

}
