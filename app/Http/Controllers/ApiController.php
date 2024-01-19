<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Item;
use App\Models\Transaction;

class ApiController extends Controller
{

    public function item($id) {
        $item = Item::find($id);
        return response()->json($item);
    }

    public function items() {
        $items = Item::all();
        return response()->json($items);
    }

    public function handleTransaction(Request $request) {
        $requestData = $request->json()->all();

        $validator = Validator::make($requestData, [
            'officer' => 'required|string',
            'items' => 'required|array',
            'price' => 'required|numeric',
            'note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $requestData = collect($requestData);

        try {
            \DB::beginTransaction();

            foreach ($requestData->get('items') as $itemId) {
                $item = Item::find($itemId);

                if ($item) {
                    $item->update([
                        'stok' => $item->stok - 1,
                    ]);
                }
            }

            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $transaction = new Transaction;
        $transaction->officer = $requestData->get('officer');
        $transaction->date = now();
        $transaction->items = $requestData->get('items');
        $transaction->price = $requestData->get('price');
        $transaction->note = $requestData->get('note');
        $transaction->save();

        return response()->json(['message' => 'Transaksi berhasil disimpan'], 200);
    }

}
