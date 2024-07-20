<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Toy;
use Illuminate\Http\Request;

class ToyController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('toys.create', compact('categories'));
    }

    public function createToy(Request $request)
    {
        $image = $request->file('image');
        if ($image != null) {
            $imgName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path("img/toyImage"), $imgName);
        } else {
            $imgName = null;
        }
        Toy::create([
            'category_id' => $request->input('category'),
            'image' => $imgName,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock')
        ]);
        return redirect()->route('admin.home');
    }

    public function delete(Toy $toy)
    {
        $toy->delete();
        return redirect()->route('admin.home');

    }

    public function edit(Toy $toy)
    {
        $categories = Category::all();
        return view('toys.edit', compact(['toy', 'categories']));
    }
    
    public function update(Request $request, Toy $toy)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = time() . "_" . $image->getClientOriginalName();
            $image->move(public_path("img/toyImage"), $imgName);

            $toy->update([
                "image" => $imgName,
                "name" => $request->input('name'),
                "category" => $request->input('category'),
                "description" => $request->input('description'),
                "price" => $request->input('price'),
                "stock" => $request->input('stock')
            ]);
            $toy->save();
        } else {
            $toy->update([
                "name" => $request->input('name'),
                "category" => $request->input('category'),
                "description" => $request->input('description'),
                "price" => $request->input('price'),
                "stock" => $request->input('stock')
            ]);
            $toy->save();
        }
        return redirect()->route('admin.home');
    }

    public function order(Toy $toy)
    {
        $toy_id = $toy->id;
        $cart = session()->get('cart', []);
        if(isset($cart[$toy_id])) {
            $cart[$toy_id]['quantity']++;
        } else {
            $cart[$toy_id] = [
                "id" => $toy_id,
                'name' => $toy->name,
                'image' => $toy->image,
                'category' => $toy->category->name,
                'price' => $toy->price,
                'quantity' => 1,
                'stock' => $toy->stock
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function deleteOrder($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.home');
    }


}
