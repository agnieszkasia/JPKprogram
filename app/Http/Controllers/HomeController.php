<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $user = Auth::user();
        $invoices = $user->invoices()->orderBy('invoice_number', 'desc')->limit(3)->get();
        $purchaseInvoices = $user->purchaseInvoices()->orderBy('invoice_number', 'desc')->limit(3)->get();

        $taxSettlements = $user->taxSettlements()
                            ->orderBy('year', 'desc')
                            ->orderBy('month', 'desc')
                            ->limit(3)
                            ->get();

        $i = 0;
        foreach ($taxSettlements as $taxSettlement){
            $taxSettlements[$i]->vat = $taxSettlement->sale_vat - $taxSettlement->purchase_vat;
            $i++;
        }

        return view('home', compact('invoices', 'purchaseInvoices', 'taxSettlements'));
    }
}
