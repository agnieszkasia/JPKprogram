<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxSettlementController extends Controller{

    function showAllTaxSettlement(){

//        dd($month);

        return view('tax_settlements.show_all');
    }

    public function create(){
        $user = Auth::user();
        $invoices = $user->invoices;
        for ($i =0; $i<count($invoices); $i++){
            $month_numbers[$i] = substr($invoices[$i]->due_date, 0, -3);
        }
        $unique_month_numbers = array_unique($month_numbers);
        $i=0;
        foreach ($unique_month_numbers as $row){
            $month[$i] = substr($row, 5, 2);
            $year[$i] = substr($row, 0, -3);
            $i++;
        }
        $unique_year = array_unique($year);
//        dd($month, $year);
        return view('tax_settlements.create', compact('month', 'unique_year'));
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

    function getInvoicesForTheMonth($month, $year){

    }
}
