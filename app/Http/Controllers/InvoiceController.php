<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;


class InvoiceController extends Controller{

    public function showALl(){
        $user = Auth::user();
        $invoices = $user->invoices;
        $invoicesNumber = count($invoices);
        $price = array();
        for ($i=0; $i<$invoicesNumber;$i++) {
            $productsData = explode(';',$invoices[$i]->products);
            $productsNumber = count($productsData)/3;
//            dd($productsData);
            $price[$i] = 0;
            for ($j=0; $j<$productsNumber;$j++){
                $product_price[$j] = $productsData[$j*3+2];
                $price[$i] = $price[$i]+(int)$product_price[$j];
            }
        }
        return view('invoices/show_all', compact('invoices', 'price'));
    }

    public function create(){
        $last_invoice = Auth::user()->invoices->last();
        if ($last_invoice->invoice_number == null){
            $invoice_number_temp = 1;
        } else {
            $invoice_number_temp = (int)$last_invoice->invoice_number;
        }
        $invoice_number = ($invoice_number_temp+1)."_".Carbon::now()->year;
        $currentDate = Carbon::now()->toDateString();
        return view('invoices.create', compact('currentDate', 'invoice_number'));
    }

    public function store(Request $request){
        $products = $this->getProductsToString($request);
        $invoice = Invoice::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'invoice_number' => $request->input('invoice_number'),
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

    public function getAuthUserData(){
        return $user = Auth::user();
    }

    public function getAuthUserInvoices(){
        $user = $this->getAuthUserData();
        return $invoices = $user->invoices;
    }

    public function show($id){
        $user = Auth::user();

        $invoice = Invoice::find($id);

        $products = explode(';',$invoice->products);
        $productsNumber = count($products)/3;
        $all_products_price[0] = 0;
        $all_products_price[1] = 0;
        $all_products_price[2] =0;
        for ($i=0; $i<$productsNumber; $i++){
            $product[$i][0] = $products[$i*3];
            $product[$i][1] = $products[$i*3+1];
            $product[$i][2] = $products[$i*3+2];
            $product[$i][3] = round($products[$i*3+2]*$products[$i*3+1]/1.23,2);
            $product[$i][4] = round($products[$i*3+2]*$products[$i*3+1]/1.23*0.23,2);
            $product[$i][5] = $products[$i*3+2]*$products[$i*3+1];
            $all_products_price[0] = ($all_products_price[0] + $product[$i][3]);
            $all_products_price[1] = ($all_products_price[1] + $product[$i][4]);
            $all_products_price[2] = ($all_products_price[2] + $product[$i][5]);
        }
        return view('invoices/show',compact('invoice', 'product', 'productsNumber', 'user', 'all_products_price'));
    }

    public function edit($id){
        $invoice = Invoice::find($id);

        $products = explode(';',$invoice->products);
        $productsNumber = count($products)/3;
        for ($i=0; $i<$productsNumber; $i++){
                $product[$i][0] = $products[$i*3];
                $product[$i][1] = $products[$i*3+1];
                $product[$i][2] = $products[$i*3+2];

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

    public function generate_pdf($id){
        $user = Auth::user();

        $invoice = Invoice::find($id);

        $product = array();
        $products = explode(';',$invoice->products);
        $productsNumber = count($products)/3;
        $all_products_price[0] = 0;
        $all_products_price[1] = 0;
        $all_products_price[2] =0;
        for ($i=0; $i<$productsNumber; $i++){
            $product[$i][0] = $products[$i*3];
            $product[$i][1] = $products[$i*3+1];
            $product[$i][2] = $products[$i*3+2];
            $product[$i][3] = round($products[$i*3+2]*$products[$i*3+1]/1.23,2);
            $product[$i][4] = round($products[$i*3+2]*$products[$i*3+1]/1.23*0.23,2);
            $product[$i][5] = $products[$i*3+2]*$products[$i*3+1];
            $all_products_price[0] = ($all_products_price[0] + $product[$i][3]);
            $all_products_price[1] = ($all_products_price[1] + $product[$i][4]);
            $all_products_price[2] = ($all_products_price[2] + $product[$i][5]);
        }
        $invoice_name = "FV-".$invoice->invoice_number.".pdf";

        $html = view('invoices/pdf', compact('invoice', 'product', 'productsNumber', 'user', 'all_products_price'));

        $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream((string)$invoice_name, ['Attachment' => true]);


    }

}
