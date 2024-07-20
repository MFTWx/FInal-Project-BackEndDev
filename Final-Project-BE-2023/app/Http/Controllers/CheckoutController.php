<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\InvoiceHeader;
use App\Models\Toy;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function cart()
    {
        $toys = session()->get('cart', []);
        return view('cart.index', compact('toys'));
    }

    public function store(Request $request)
    {

        $cart = session()->get('cart', []);
        $invoice = InvoiceHeader::create([
            'user_id' => auth()->user()->id,
            'total_price' => $request->input('total_price'),
        ]);

        $total = 0;

        foreach($cart as $item){
            InvoiceDetail::create([
                'invoice_header_id' => $invoice->id,
                'toy_id' => $item['id'],
                'quantity' => $item['quantity'],
                "subTotal" => $item['quantity'] * $item['price']
            ]);

            $total += $item['quantity'] * $item['price'];

            $this->reduceStock($item['id'], $item['quantity']);
        }

        $total += 50000;

        session()->forget('cart');
        return redirect()->route('payment', compact('total'));
    }

    public function reduceStock($toy_id, $quantity)
    {
        $toy = Toy::find($toy_id);
        $toy->stock -= $quantity;
        $toy->save();
    }
}