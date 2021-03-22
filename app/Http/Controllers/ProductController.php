<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller{

    public function index(){

        $user = Auth::user();
        $magazine = $user->magazine->products;

        return view('products/show_all', compact('magazine'));
    }

    public function create(){
        //
    }

    public function store(Request $request){
        $product = Product::create([
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),

        ]);

        $user = Auth::user();
        $magazine = $user->magazine;
        $products = $magazine->products()->attach($product->id);

        return redirect(route('products'));
    }

    public function show($id){
        $product = Product::find($id);
        return view('products/show',compact('product'));
    }

    public function edit($id){
        $product = Product::find($id);
        return view('products/edit', compact('product'));
    }

    public function update(Request $request, $id){
        Product::find($id)->update([
            'name' => $request->input('name'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);
        return redirect(route('products'));
    }

    public function destroy($id){
        Product::find($id)->delete();
        return redirect(route('products'));
    }
}
