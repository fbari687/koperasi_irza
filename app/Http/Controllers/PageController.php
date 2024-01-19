<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Events\MyEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $client;

    public function __construct() {
        $this->client = new Client([
            'verify' => base_path('cacert.pem'),
        ]);
    }
    
    public function dashboard() { 
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
    }

    public function messages() {
        return view('page.messages', [
            'title' => "Koperasi - Chatting",
            'bgMenu' => 'chatting'
        ]);
    }

    public function officer() {
        $users = User::all();

        return view('page.student-affairs.officer', [
            'title' => "Koperasi - Petugas",
            'bgMenu' => 'officer',
            'users' => $users
        ]);
    }

    public function item() {
        $items = Item::orderBy('created_at', 'desc')->get();
        $filters = ['terbaru', 'terlama', 'termahal', 'termurah', 'tersedia', 'habis'];
        $random = Item::find(1);

        return view('page.coperation.item', [
            'title' => 'Koperasi - Barang',
            'bgMenu' => 'item',
            'items' => $items,
            'filters' => $filters,
            'random' => $random
        ]);
    }

    public function report() {
        return view('page.coperation.report', [
            'title' => "Koperasi - Laporan",
            'bgMenu' => 'report'
        ]);
    }

    public function handleBroad() {
        event(new MyEvent('Hello, world!'));
        return response()->json(['message' => 'Event broadcasted']);
    }

}
