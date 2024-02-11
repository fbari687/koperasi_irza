<?php

namespace App\Http\Controllers;

use App\Events\HelloEvent;
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

use function React\Promise\all;

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
            $response = $this->client->put('http://localhost:8001/api/students/' . $id, [
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
            $response = $this->client->delete('http://localhost:8001/api/students/' . $id);

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
            $response = $this->client->get('http://localhost:8001/api/students/' . $id);

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

            dd($data, $status);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    public function testEvent()
    {
        $response = $this->client->get('https://api.quotable.io/random?minLength=150');
        $data = json_decode($response->getBody()->getContents(), true);
        Broadcast(new HelloEvent($data));
    }




















    public function dashboard()
    {
        try {
            $response = $this->client->get('http://api.quotable.io/random?minLength=150');
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

        // return view('page.dashboard', [
        //     'title' => 'Hello ' . ucfirst(auth()->user()->name) . ' ^_^',
        //     'bgMenu' => 'dashboard',
        //     'quote' => collect(['content' => 'Belum ada quotes untuk anda hari ini']),
        // ]);
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

    public function officerAdd(Request $req)
    {
        if (Auth::user()->role == 'admin') {
            // dd($req->all());
            $validator = Validator::make($req->all(), [
                'name' => 'required',
                'role' => 'required',
                'classes' => 'required',
                'nis' => 'required|numeric',
                'telephone' => 'required',
                'email' => 'required',
                'password' => 'required',
                'image' => '',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                'name' => $req->name,
                'role' => $req->role,
                'class' => $req->classes,
                'nis' => $req->nis,
                'telephone' => $req->telephone,
                'email' => $req->email,
                'password' => bcrypt($req->password),
                'photo' => '',
            ];

            if ($req->hasFile('image')) {
                $file = $req->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::slug($req->name) . '.' . $extension;
                $path = $file->storeAs('photo-user', $fileName);
                $data['photo'] = $path;
            }

            User::create($data);

            return redirect()->back()->with('success', 'USER BERHASIL DIBUAT');
        } else {
            return redirect()->back()->with('error', 'HAK AKSES KAMU TERBATAS');
        }
    }

    public function officerEdit(Request $req, $id)
    {
        if (Auth::user()->role == 'admin') {
            // dd($req->all(), $id);
            $user = User::findOrFail($id);

            $validator = Validator::make($req->all(), [
                'name' => 'required',
                'role' => 'required',
                'classes' => 'required',
                'nis' => 'required|numeric',
                'telephone' => 'required',
                'email' => 'required|unique:users,email,' . $user->id,
                'password' => '',
                'image' => '',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                'name' => $req->name,
                'role' => $req->role,
                'class' => $req->classes,
                'nis' => $req->nis,
                'telephone' => $req->telephone,
                'email' => $req->email,
                'password' => $user->password,
                'photo' => $user->photo,
            ];

            if ($req->password) {
                $data['password'] = bcrypt($req->password);
            }

            $oldImage = $user->image;

            if ($req->hasFile('image')) {

                if ($oldImage) {
                    Storage::delete($oldImage);
                }

                $file = $req->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::slug($req->name) . '.' . $extension;
                $path = $file->storeAs('photo-user', $fileName);
                $data['photo'] = $path;
            }

            $user->update($data);

            return redirect()->back()->with('success', 'INFORMASI USER BERHASIL DIEDIT');
        } else {
            return redirect()->back()->with('error', 'HAK AKSES KAMU TERBATAS');
        }
    }


    public function officerDelete(Request $req, $id)
    {
        if (Auth::user()->role == 'admin') {
            $user = User::findOrFail($id);
            $oldImage = $user->photo;
            // dd($oldImage);

            if ($oldImage) {
                Storage::delete($oldImage);
            }

            $user->delete();

            return redirect()->back()->with('success', 'BERHASIL MENGHAPUS USER');

        } else {
            return redirect()->back()->with('error', 'HAK AKSES KAMU TERBATAS');
        }
    }




    public function classes()
    {
        // $users = User::all();
        $classes = [
            [
                'name' => 'XII-RPL',
                'total' => 10
            ],
            [
                'name' => 'XI-PPLG',
                'total' => 10
            ],
            [
                'name' => 'X-PPLG',
                'total' => 10
            ],
            [
                'name' => 'XII-MM',
                'total' => 10
            ],
            [
                'name' => 'XI-MM',
                'total' => 10
            ],
            [
                'name' => 'X-MM',
                'total' => 10
            ],
        ];

        return view('page.student-affairs.classes', [
            'title' => "Koperasi - Classes",
            'bgMenu' => 'classes',
            'classes' => $classes
            // 'users' => $users
        ]);
    }







    public function item()
    {
        // $items = Item::orderBy('created_at', 'desc')->get();
        $filters = ['terbaru', 'terlama', 'termahal', 'termurah', 'tersedia', 'habis'];

        $response = $this->client->get('http://localhost:4444/item');
        $json = json_decode($response->getBody()->getContents(), true)['data'];
        // $collection = collect($json);

        // // Menghitung jumlah halaman
        // $totalItems = $collection->count();
        // $itemsPerPage = 3;
        // $totalPages = ceil($totalItems / $itemsPerPage);

        // // Mendapatkan nomor halaman dari parameter query string jika tersedia, jika tidak, menggunakan halaman pertama
        // $currentPage = request()->has('page') ? request()->query('page') : 1;

        // // Mengambil data untuk halaman yang ditentukan
        // $data = $collection->forPage($currentPage, $itemsPerPage);

        return view('page.coperation.item', [
            'title' => 'Koperasi - Barang',
            'bgMenu' => 'item',
            'filters' => $filters,
            'data' => collect($json),
        ]);
    }

    // function createSlug($string) {
    //     $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    //     return $slug;
    // }

    public function itemAdd(Request $req)
    {
        // dd($req->all());
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            // 'status' => 'required',
            // 'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $req->name,
            'slug' => Str::slug($req->name),
            'description' => $req->description,
            'price' => $req->price,
            'stock' => $req->stock,
            'status' => 'available',
            'image' => null,
        ];

        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $data['slug'] . '.' . $extension;
            $path = $file->storeAs('products', $fileName);
            $data['image'] = $path;
        }

        try {
            $response = $this->client->post('http://localhost:4444/item', [
                'form_params' => $data
            ]);

            $status = $response->getStatusCode();

            $data = json_decode($response->getBody()->getContents(), true);

            // return redirect('items')->with('success', 'BERHASIL MENAMBAH PRODUK');
            return response()->json([
                'status' => $status,
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function itemEdit(Request $req)
    {
        // dd($req->all());

        try {
            $getProduct = $this->client->get('http://localhost:4444/item');
            $product = json_decode($getProduct->getBody()->getContents(), true)['data'];
            $imageProduct = '';
            foreach ($product as $item) {
                if ($req->id == $item['id']) {
                    $imageProduct = $item['image'];
                }
            }

            $validator = Validator::make($req->all(), [
                'id' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                'name' => $req->name,
                'slug' => Str::slug($req->name),
                'description' => $req->description,
                'price' => $req->price,
                'stock' => $req->stock,
                // 'status' => $user['status'],
                'image' => $req->image,
            ];

            if ($req->hasFile('image')) {
                if ($imageProduct) {
                    Storage::delete($imageProduct);
                }

                $file = $req->file('image');
                $extension = $file->getClientOriginalExtension();
                $fileName = $data['slug'] . '.' . $extension;
                $path = $file->storeAs('products', $fileName);
                $data['image'] = $path;
            }

            try {
                $response = $this->client->put('http://localhost:4444/item?id=' . $req->id, [
                    'form_params' => $data,
                ]);

                $data = json_decode($response->getBody()->getContents(), true)['data'];

                return response()->json([
                    'status' => $response->getStatusCode(),
                    'data' => $data
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'errors' => $e->getMessage(),
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'errors' => $e->getMessage(),
            ]);
        }
    }

    public function itemDelete($id)
    {
        try {
            $getProduct = $this->client->get('http://localhost:4444/item');
            $items = json_decode($getProduct->getBody()->getContents(), true)['data'];
            $oldImg = '';
            foreach ($items as $item) {
                if ($item['id'] == $id) {
                    $oldImg = $item['image'];
                }
            }
            if ($oldImg) {
                Storage::delete($oldImg);
            }

            $response = $this->client->delete('http://localhost:4444/item?id=' . $id);

            return response()->json([
                'success' => true,
                'status' => $response->getStatusCode(),
                'data' => json_decode($response->getBody()->getContents(), true)['data'],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'errors' => $e->getMessage()
            ]);
        }
    }

    public function itemView($id)
    {
        try {
            $response = $this->client->get('api_url' . $id);

            $data = json_decode($response->getBody()->getContents(), true)['data'];

            return view('page.coperation.item.DETAIL?', [
                'title' => $data['slug'],
                'bgMenu' => 'items',
                'item' => collect($data),
            ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->with('errors', 'ERROR WHILE FETCHING DATA ITEM');
        }
    }



    public function report()
    {
        return view('page.coperation.report', [
            'title' => "Koperasi - Laporan",
            'bgMenu' => 'report'
        ]);
    }

    // public function handleBroad()
    // {
    //     event(new MyEvent('Hello, world!'));
    //     return response()->json(['message' => 'Event broadcasted']);
    // }


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
