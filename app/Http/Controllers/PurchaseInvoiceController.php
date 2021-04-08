<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseInvoiceController extends Controller{
    public function showALl(){
        $user = Auth::user();
        $purchaseInvoices = $user->purchaseInvoices;
//        $invoicesNumber = count($purchaseInvoices);
        return view('purchase_invoices/show_all', compact('purchaseInvoices'));
    }

    public function create(){
        return view('purchase_invoices.create');
    }

    public function store(Request $request){
        $purchaseInvoice = PurchaseInvoice::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'invoice_number' => $request->input('invoice_number'),
            'company' => $request->input('company'),
            'street_name' => $request->input('street_name'),
            'house_number' => $request->input('house_number'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'nip' => $request->input('nip'),
            'issue_date' => $request->input('issue_date'),
            'due_date' => $request->input('due_date'),
            'vat' => $request->input('vat'),
            'netto' => $request->input('netto'),
            'brutto' => $request->input('brutto'),

        ]);

        $user = Auth::user();
        $user->purchaseInvoices->add($purchaseInvoice);

        return redirect(route('purchase_invoices'));
    }


    public function show($id){
        $user = Auth::user();

        $purchaseInvoice = PurchaseInvoice::find($id);
        return view('purchase_invoices/show',compact('purchaseInvoice', 'user'));
    }

    public function edit($id){
        $purchaseInvoice = PurchaseInvoice::find($id);
        return view('purchase_invoices/edit', compact('purchaseInvoice'));
    }

    public function update(Request $request, $id){

        PurchaseInvoice::find($id)->update([
            'invoice_number' => $request->input('invoice_number'),
            'company' => $request->input('company'),
            'street_name' => $request->input('street_name'),
            'house_number' => $request->input('house_number'),
            'postal_code' => $request->input('postal_code'),
            'city' => $request->input('city'),
            'nip' => $request->input('nip'),
            'issue_date' => $request->input('issue_date'),
            'due_date' => $request->input('due_date'),
            'vat' => $request->input('vat'),
            'netto' => $request->input('netto'),
            'brutto' => $request->input('brutto'),

        ]);
        return redirect(route('purchase_invoices'));
    }

    public function destroy($id){
        PurchaseInvoice::find($id)->delete();
        return redirect(route('purchase_invoices'));
    }


}
