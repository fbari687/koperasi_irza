<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class PageController extends Controller
{
    protected $apiEndpoint;

    public function __construct()
    {
        // $this->client = new Client([
        //     'verify' => base_path('cacert.pem'),
        // ]);
        $this->apiEndpoint = env('API_ENDPOINT');
    }


    public function dashboard()
    {

        try {
            $response = Http::get('http://api.quotable.io/random?minLength=150');
            $quote = json_decode($response, true);

            $responseTransaction = Http::get($this->apiEndpoint . "/transaction");
            $data = json_decode($responseTransaction, true);
            $transactionsData = $data['data'];
            $transactions = collect($transactionsData);

            $responseItems = Http::get($this->apiEndpoint . "/item?sold=terlaris");
            $json = json_decode($responseItems, true);
            $itemsC = collect($json['data']);
            $items = $itemsC->all();

            return view('page.dashboard', [
                'title' => 'Hello ' . ucfirst(auth()->user()->name) . ' ^_^',
                'bgMenu' => 'dashboard',
                'quote' => collect($quote),
                'transactions' => $transactions,
                'items' => $items,
                'countItems' => $itemsC->count(),
                'countTransaction' => $transactions->count()
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
        $filters = ['terlaris', 'tersepi', 'terbanyak', 'tersedikit', 'available', 'unavailable'];

        $response = Http::get($this->apiEndpoint . "/item");
        $json = json_decode($response, true);
        $itemsC = collect($json['data']);
        $items = $itemsC->all();
        $ranItems = $itemsC->take(4);

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
            'items' => $items,
            'ranItems' => $ranItems,
        ]);
    }

    // function createSlug($string) {
    //     $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    //     return $slug;
    // }

    public function getItems(Request $request)
    {
        $url = $this->apiEndpoint . "/item";
        if ($request->query('sold')) {
            $url = $this->apiEndpoint . "/item?sold=" . $request->query('sold');
        } else if ($request->query('stock')) {
            $url = $this->apiEndpoint . "/item?stock=" . $request->query('stock');
        } else if ($request->query('status')) {
            $url = $this->apiEndpoint . "/item?status=" . $request->query('status');
        }

        $response = Http::get($url);
        $json = json_decode($response, true);
        $items = collect($json['data']);
        $items = $items->all();

        return response()->json([
            'data' => $items
        ]);
    }

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
            $image = $req->file('image')->store('products');
            $data['image'] = asset("storage/" . $image);
        }

        try {
            $response = Http::post($this->apiEndpoint . '/item', $data);

            if ($response->failed()) {
                throw new Exception('API request failed with status code ' . $response->status());
            }

            return redirect('/items')->with([
                'success' => "Berhasil Menambahkan Produk"
            ]);
        } catch (Throwable $e) {
            return redirect('/items')->with([
                'error' => $e->getMessage()
            ]);
        }
    }
    public function getOneItem(string $id)
    {
        $id = (int)$id;
        $response = Http::get($this->apiEndpoint . "/item/find?id=" . $id);
        $data = json_decode($response, true)['data'];
        $item = collect($data);

        return response()->json([
            'data' => $item->all()
        ]);
    }


    public function itemEdit(Request $req)
    {
        $validated = $req->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'description' => 'required'
        ]);

        if ($req->hasFile('image')) {
            $req->validate([
                'image' => 'image'
            ]);

            $image = $req->image->store('products');
            $validated['image'] = asset('storage/' . $image);
            $filename = basename(parse_url($req->oldImage)['path']);
            Storage::delete('public/products/' . $filename);
        } else {
            $validated['image'] = $req->oldImage;
        }

        $validated['price'] = (int)$validated['price'];
        $validated['stock'] = (int)$validated['stock'];
        $validated['slug'] = Str::slug($req->name);

        try {
            $response = Http::put($this->apiEndpoint . "/item?id=" . $validated['id'], $validated);

            if ($response->failed()) {
                throw new Exception('API request failed with status code ' . $response->status());
            }

            return redirect('/items')->with([
                'success' => "Berhasil Mengubah Produk"
            ]);
        } catch (Throwable $e) {
            return redirect('/items')->with([
                'errors' => $e->getMessage(),
            ]);
        }
    }

    public function itemDelete(string $id)
    {
        $id = (int)$id;
        $getResponse = Http::get($this->apiEndpoint . "/item/find?id=" . $id);
        $data = json_decode($getResponse, true)['data'];
        $item = collect($data);
        $filename = basename(parse_url($item['image'])['path']);

        try {
            $response = Http::delete($this->apiEndpoint . "/item?id=" . $id);
            Storage::delete('public/products/' . $filename);

            if ($response->failed()) {
                throw new Exception('API request failed with status code ' . $response->status());
            }

            return redirect('/items')->with([
                'success' => "Berhasil Menghapus Produk"
            ]);
        } catch (Throwable $e) {
            return redirect('/items')->with([
                'errors' => $e->getMessage()
            ]);
        }
    }

    // public function itemView($id)
    // {
    //     try {
    //         $response = $this->client->get('api_url' . $id);

    //         $data = json_decode($response->getBody()->getContents(), true)['data'];

    //         return view('page.coperation.item.DETAIL?', [
    //             'title' => $data['slug'],
    //             'bgMenu' => 'items',
    //             'item' => collect($data),
    //         ]);
    //     } catch (Exception $e) {
    //         return redirect()->back()->withErrors($e->getMessage())->with('errors', 'ERROR WHILE FETCHING DATA ITEM');
    //     }
    // }



    public function report()
    {
        $response = Http::get($this->apiEndpoint . "/transaction");
        $data = json_decode($response, true);
        $transactionsData = $data['data'];
        $transactions = collect($transactionsData);

        return view('page.coperation.report', [
            'title' => "Koperasi - Laporan",
            'bgMenu' => 'report',
            'transactions' => $transactions
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

    public function transactionView()
    {
        $response = Http::get($this->apiEndpoint . "/transaction");
        $data = json_decode($response, true);
        $transactionsData = $data['data'];
        $transactions = collect($transactionsData);

        return view('page.coperation.transaction', [
            'title' => 'Koperasi - Transaksi',
            'bgMenu' => "transaksi",
            'transactions' => $transactions
        ]);
    }

    public function timetableView()
    {
        $timetables = [
            [
                'title' => 1,
                'start' => '2024-02-14',
                'allDay' => true
            ],
            [
                'title' => 1,
                'start' => '2024-02-15',
                'allDay' => true
            ],
        ];

        $collection = new Collection();
        foreach ($timetables as $timetable) {
            $collection->push((object)[
                'title' => User::where('id', $timetable['title'])->first()->name,
                'start' => $timetable['start'],
                'allDay' => $timetable['allDay']
            ]);
        }

        $timetable = $collection->all();

        $users = User::all();

        return view('page.coperation.timetable', [
            'title' => 'Koperasi - Jadwal',
            'bgMenu' => "Jadwal",
            'timetables' => $timetable,
            'users' => $users
        ]);
    }
}
