<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InvoiceController extends Controller{

    public function showALl(){
        $user = Auth::user();
        $invoices = $user->invoices;


        return view('invoices.show_all', compact('invoices'));
    }

    public function create(){

        /* create invoice number automatically */
        $last_invoice = Auth::user()->invoices->last();

        if ($last_invoice->invoice_number == null){
            $invoice_number_temp = 1;
        } else {
            $invoice_number_temp = (int)$last_invoice->invoice_number;
        }
        $invoice_number = ($invoice_number_temp+1)."_".Carbon::now()->year;

        /* get current date */
        $currentDate = Carbon::now()->toDateString();

        return view('invoices.create', compact('currentDate', 'invoice_number'));
    }

    public function store(Request $request){

        $products = $this->getProductsToString($request);
        $prices = $this->getInvoicePrice($request);

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
            'vat' => $prices['vat'],
            'netto' => $prices['netto'],
            'brutto' => $prices['brutto'],

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

    public function getInvoicePrice($request){
        $price['vat'] = 0;
        $price['netto'] = 0;
        $price['brutto'] = 0;
        $prices = $request->input('price');
        $quantities = $request->input('quantity');
        for ($i=0; $i<count($prices); $i++){
            $price['vat'] = $price['vat'] + round($prices[$i]*$quantities[$i]/1.23*0.23,2);
            $price['netto'] = $price['netto'] + round($prices[$i]*$quantities[$i]/1.23,2);
            $price['brutto'] = $price['brutto'] + $prices[$i]*$quantities[$i];
        }

        return $price;
    }

    public function show($id){
        $user = Auth::user();

        $invoice = Invoice::find($id);
        $products = explode(';',$invoice->products);
        $productsNumber = count($products)/3;
        list($product) = $this->getTotalInvoicePrice($id);

        return view('invoices/show',compact('invoice', 'product', 'productsNumber', 'user'));
    }

    public function getTotalInvoicePrice($id): array{
        $invoice = Invoice::find($id);
        $products = explode(';',$invoice->products);
        $productsNumber = count($products)/3;

        $product = array();
        for ($i=0; $i<$productsNumber; $i++){
            $product[$i][0] = $products[$i*3];
            $product[$i][1] = $products[$i*3+1];
            $product[$i][2] = $products[$i*3+2];
            $product[$i][3] = round($products[$i*3+2]*$products[$i*3+1]/1.23,2);
            $product[$i][4] = round($products[$i*3+2]*$products[$i*3+1]/1.23*0.23,2);
            $product[$i][5] = $products[$i*3+2]*$products[$i*3+1];
        }
        return array($product);
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
        $prices = $this->getInvoicePrice($request);

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
            'vat' => $prices['vat'],
            'netto' => $prices['netto'],
            'brutto' => $prices['brutto'],
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

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream((string)$invoice_name, ['Attachment' => true]);


    }

}
