<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Events\MyEvent;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PageController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => base_path('cacert.pem'),
        ]);
    }


    public function testAddApi(Request $req)
    {
        // dd($req->all());
        try {
            $response = $this->client->post('http://localhost:8001/api/students', [
                'form_params' => $req->all(),
            ]);
            $status = $response->getStatusCode();
            $data = $response->getBody()->getContents();

            dd($data);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function testPutApi(Request $req, $id)
    {
        try {
            $response = $this->client->put('http://localhost:8001/api/students/'.$id, [
                'form_params' => $req->all(),
            ]);

            $status = $response->getStatusCode();
            $data = json_decode($response->getBody()->getContents(), true)['message'];

            dd($data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function testDeleteApi(Request $req, $id)
    {
        try {
            $response = $this->client->delete('http://localhost:8001/api/students/'.$id);

            $status = $response->getStatusCode();

            $data = json_decode($response->getBody()->getContents(), true)['message'];

            dd($data);

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function testViewApi(Request $req, $id)
    {
        try {
            $response = $this->client->get('http://localhost:8001/api/students/'.$id);

        $status = $response->getStatusCode();

        $data = json_decode($response->getBody()->getContents(), true);

        dd($data);

        // $data = json_decode($response->getBody()->getContents(), true)['data'];

        // dd($data['name']);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function testDelWhichApi(Request $req)
    {
        try {
            $response = $this->client->post('http://localhost:8001/api/students/delete', [
                'form_params' => $req->all(),
            ]);

            $status = $response->getStatusCode();
            $data = json_decode($response->getBody()->getContents(), true);

            dd($data);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
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

        $response = $this->client->get('https://api.publicapis.org/entries');
        $json = json_decode($response->getBody()->getContents(), true)['entries'];
        $collection = collect($json);

        // Menghitung jumlah halaman
        $totalItems = $collection->count();
        $itemsPerPage = 3;
        $totalPages = ceil($totalItems / $itemsPerPage);

        // Mendapatkan nomor halaman dari parameter query string jika tersedia, jika tidak, menggunakan halaman pertama
        $currentPage = request()->has('page') ? request()->query('page') : 1;

        // Mengambil data untuk halaman yang ditentukan
        $data = $collection->forPage($currentPage, $itemsPerPage);

        return view('page.coperation.item', [
            'title' => 'Koperasi - Barang',
            'bgMenu' => 'item',
            'filters' => $filters,
            'data' => collect($data),
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

    public function changePhotoProfile(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'photo' => 'required|max:5000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'photo' => $req->photo,
        ];

        $oldImage = Auth::user()->photo;

        if ($req->hasFile('photo')) {

            if ($oldImage) {
                Storage::delete($oldImage);
            }

            $file = $req->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName() . '-' . Str::random(4) . '-' . $extension;
            $path = $file->storeAs('photo-user', $filename);
            $data['photo'] = $path;
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->update($data);

        return redirect()->back()->with('success', 'SUCCESSFULLY CHANGE PROFILE PICTURE!');
    }

    public function editProfile(Request $req)
    {
        if ($req->password) {
            $validator = Validator::make($req->all(), [
                'name' => ['required', 'string'],
                'nis' => ['nullable', 'numeric'],
                'telephone' => ['nullable', 'numeric'],
                'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
                'password' => ['required', 'min:6'],
                'class' => ['required'],
            ]);
        } else {
            $validator = Validator::make($req->all(), [
                'name' => ['required', 'string'],
                'nis' => ['nullable', 'numeric'],
                'telephone' => ['nullable', 'numeric'],
                'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
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
