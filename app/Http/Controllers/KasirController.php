<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {

        return view('page.coperation.cashier', [
            // 'title' => 'Kasir',
            // 'bgMenu' => 'kasir',
        ]);
    }

    public function submit(Request $req)
    {
        dd($req->all());
    }
}
