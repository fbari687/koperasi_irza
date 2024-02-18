<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class KasirController extends Controller
{
    protected $apiEndpoint;

    public function __construct()
    {
        // $this->client = new Client([
        //     'verify' => base_path('cacert.pem'),
        // ]);
        $this->apiEndpoint = env('API_ENDPOINT');
    }

    public function index()
    {

        return view('page.coperation.cashier', [
            // 'title' => 'Kasir',
            // 'bgMenu' => 'kasir',
        ]);
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'totalPrice' => "required",
            'itemId' => "required",
            'quantity' => "required"
        ]);

        for ($i = 0; $i < count($validated['itemId']); $i++) {
            $item = [
                'itemId' => (int)$validated['itemId'][$i],
                'quantity' => (int)$validated['quantity'][$i],
            ];
            $outputData[] = $item;
        }

        $data = [
            'prices' => (int)$validated['totalPrice'],
            'items' => $outputData
        ];

        try {
            $response = Http::post($this->apiEndpoint . "/transaction/bulk", $data);

            if ($response->failed()) {
                throw new Exception('API request failed with status code ' . $response->status());
            }
            return redirect('/cashier')->with('success', 'Berhasil Checkout');
        } catch (Throwable $th) {
            dd($th);
        }
    }
}
