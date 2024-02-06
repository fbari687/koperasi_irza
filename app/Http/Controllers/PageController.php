<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Events\MyEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => base_path('cacert.pem'),
        ]);
    }

    public function dashboard()
    {
        try {
            $response = $this->client->get('https://api.quotable.io/random?minLength=150');
            $quote = json_decode($response->getBody()->getContents(), true);

            return view('page.dashboard', [
                'title' => 'Hello ' . ucfirst(auth()->user()->name) . ' ^_^',
                'bgMenu' => 'dashboard',
                'quote' => collect($quote),
            ]);
        } catch (RequestException $e) {
            return view('page.dashboard', [
                'title' => 'Hello ' . ucfirst(auth()->user()->name) . ' ^_^',
                'bgMenu' => 'dashboard',
                'quote' => collect(['content' => 'Belum ada quotes untuk anda hari ini']),
            ]);
        }

        // $response = $this->client->get('https://api.quotable.io/random?minLength=150');
        //     $quote = json_decode($response->getBody()->getContents(), true);
        //     // dd($quote['content']);
        //     return view('page.dashboard', [
        //         'title' => 'Hello ' . ucfirst(auth()->user()->name) . ' ^_^',
        //         'bgMenu' => 'dashboard',
        //         'quote' => collect($quote),
        //     ]);
    }

    public function messages()
    {
        return view('page.messages', [
            'title' => "Koperasi - Chatting",
            'bgMenu' => 'chatting'
        ]);
    }

    public function officer()
    {
        $users = User::all();

        return view('page.student-affairs.officer', [
            'title' => "Koperasi - Petugas",
            'bgMenu' => 'officer',
            'users' => $users
        ]);
    }

    public function item()
    {
        // $items = Item::orderBy('created_at', 'desc')->get();
        $filters = ['terbaru', 'terlama', 'termahal', 'termurah', 'tersedia', 'habis'];
        // $random = Item::find(1);

        // return view('page.coperation.item', [
        //     'title' => 'Koperasi - Barang',
        //     'bgMenu' => 'item',
        //     'items' => $items,
        //     'filters' => $filters,
        //     'random' => $random
        // ]);

        return view('page.coperation.item', [
            'title' => 'Koperasi - Barang',
            'bgMenu' => 'item',
            'filters' => $filters,
        ]);
    }

    public function report()
    {
        return view('page.coperation.report', [
            'title' => "Koperasi - Laporan",
            'bgMenu' => 'report'
        ]);
    }

    public function handleBroad()
    {
        event(new MyEvent('Hello, world!'));
        return response()->json(['message' => 'Event broadcasted']);
    }


    public function profile()
    {
        return view('page.profile', [
            'title' => 'Hello ' . ucfirst(auth()->user()->name) . ' ^_^',
            'bgMenu' => 'profile',
        ]);
    }

    public function editProfile(Request $req)
    {
        if ($req->password) {
            $validator = Validator::make($req->all(), [
                'name' => ['required', 'string'],
                'nis' => ['nullable', 'numeric'],
                'telephone' => ['nullable', 'numeric'],
                'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
                'password' => ['required', 'min:6'],
                'class' => ['required'],
            ]);
        } else {
            $validator = Validator::make($req->all(), [
                'name' => ['required', 'string'],
                'nis' => ['nullable', 'numeric'],
                'telephone' => ['nullable', 'numeric'],
                'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
                'class' => ['required'],
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($req->password) {
            $data = [
                'name' => $req->name,
                'nis' => $req->nis,
                'class' => $req->class,
                'telephone' => $req->telephone,
                'email' => $req->email,
                'password' => bcrypt($req->password),
            ];
        } else {
            $data = [
                'name' => $req->name,
                'nis' => $req->nis,
                'class' => $req->class,
                'telephone' => $req->telephone,
                'email' => $req->email,
            ];
        }


        $user = User::findOrFail(Auth::user()->id);
        $user->update($data);


        return redirect('/profile')->with('success', 'BERHASIL MENGUPDATE DATA');
    }
}
