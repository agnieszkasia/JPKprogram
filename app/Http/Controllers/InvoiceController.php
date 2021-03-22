<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller{

    public function showALl(){
        $user = Auth::user();
        $invoices = $user->invoices;
        $invoicesNumber = count($invoices);
        for ($i=0; $i<$invoicesNumber;$i++) {
            $productsData = explode(';',$invoices[$i]->products);
            $productsNumber = count($productsData)/3;
            $price[$i] = 0;
            for ($j=0; $j<$productsNumber;$j++){
                $product[$j] = $productsData[$j*3+2];
                $price[$i] = $price[$i]+$product[$j];
            }
        }
        return view('invoices/show_all', compact('invoices', 'price'));
    }

    public function create(){
        $currentDate = Carbon::now()->toDateString();
        return view('invoices.create', compact('currentDate'));
    }

    public function store(Request $request){
        $products = $this->getProductsToString($request);

        $invoice = Invoice::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'company' => $request->input('company'),
            'street_name' => $request->input('street_name'),
            'house_number' => $request->input('house_number'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'nip' => $request->input('nip'),
            'products' => $products,
            'issue_date' => $request->input('issue_date'),
            'due_date' => $request->input('due_date'),

        ]);

        $user = Auth::user();
        $user->invoices->add($invoice);

        return redirect(route('invoices'));
    }

    function getProductsToString($request){
        $name = $request->input('name');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $product_data = null;
        for ($i=0; $i<count($name); $i++){
            $product_data[$i] = $name[$i].";".$quantity[$i].";".$price[$i];
        }
        $products = implode(';',$product_data);

        return $products;
    }

    public function show($id){
        $invoice = Invoice::find($id);
        return view('invoices/show',compact('invoice'));
    }

    public function edit($id){
        $invoice = Invoice::find($id);

        $products = explode(';',$invoice->products);
        $productsNumber = count($products)/3;
        for ($i=0; $i<$productsNumber; $i++){
            $product[0][$i] = $products[$i];
            $product[1][$i] = $products[$i+3];
            $product[2][$i] = $products[$i+6];

        }
        return view('invoices/edit', compact('invoice', 'product', 'productsNumber'));
    }

    public function update(Request $request, $id){
        $products = $this->getProductsToString($request);

        Invoice::find($id)->update([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'company' => $request->input('company'),
            'street_name' => $request->input('street_name'),
            'house_number' => $request->input('house_number'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'nip' => $request->input('nip'),
            'products' => $products,
            'issue_date' => $request->input('issue_date'),
            'due_date' => $request->input('due_date'),
        ]);
        return redirect(route('invoices'));
    }

    public function destroy($id){
        Invoice::find($id)->delete();
        return redirect(route('invoices'));
    }
}
