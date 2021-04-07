<?php

namespace App\Http\Controllers;

use App\Models\TaxSettlement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxSettlementController extends Controller{

    function showAllTaxSettlement(){
        $user = Auth::user();
        $taxSettlements = $user->taxSettlements;
        return view('tax_settlements.show_all', compact('taxSettlements'));
    }

    public function create(){
        $user = Auth::user();
        $invoices = $user->invoices;
        $dates = array();
        $years = array();

        $i=0;
        $j=0;
        foreach ($invoices as $invoice){
            $date = substr($invoice->due_date, 0, -3);
            $year = substr($date, 0, -3);

            if (!in_array($date, $dates)) {
                $dates[$i] = $date;
                if (!in_array($year, $years)) {
                    $years[$j] = $year;
                    $j++;
                }
                $i++;
            }
        }
        array_multisort($years);

        foreach ($years as $year) {
            $j=0;
            foreach ($dates as $date) {
                if (substr($date, 0, -3) ==$year){
                    $months[$year][$j] = substr($date, 5, 2);
                    $j++;
                }
            }
        }
        return view('tax_settlements.create', compact('years', 'months'));
    }

    public function generate(Request $request){
        $user = Auth::user();
        $period = $request->period;
        $invoices = $user->invoices;
        $i = 0;

        $total_month[0]=0;
        $total_month[1]=0;
        $total_month[2]=0;

        foreach ($invoices as $invoice) {
            $invoice_date = substr($invoice->due_date, 0, -3);
            if ($invoice_date == $period){
                $invoices_data[$i] = $invoice;

                $total_price = $this->getTotalInvoicePrice($invoice);
                $invoices_data[$i]->netto = $total_price[0];
                $invoices_data[$i]->vat = $total_price[1];
                $invoices_data[$i]->brutto = $total_price[2];

                $total_month[0] = $total_month[0]+($invoices_data[$i]->vat);
                $total_month[1] = $total_month[1]+($invoices_data[$i]->netto);
                $total_month[2] = $total_month[2]+($invoices_data[$i]->brutto);

                $i++;
            }
        }

        return view('tax_settlements.pre_save', compact('period', 'invoices_data', 'total_month'));
    }

    public function getTotalInvoicePrice($invoice): array{
        $products = explode(';',$invoice->products);
        $productsNumber = count($products)/3;

        $product = array();
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
        return $all_products_price;
    }

    public function store(Request $request){
        $user = Auth::user();
        $companyTaxInformation = $user->companyTaxInformation;


        $taxSettlement = TaxSettlement::create([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'form_code' => $companyTaxInformation->settlement_form,
            'form_variant' => '1',
            'date' => Carbon::now()->toDateTimeString(),
            'system_name' => 'EJPK',
            'purpose_of_submission' => '1',
            'office_code' => substr($companyTaxInformation->office_code,0,4),
            'year' => substr($request->period, 0, -3),
            'month' => substr($request->period, 5, 2),
            'invoice_ids' => '0',
            'number_of_invoices' => $request->input('number_of_invoices'),
            'vat' => $request->input('vat'),

        ]);

//        dd($taxSettlement);

        $user = Auth::user();
        $user->taxSettlements->add($taxSettlement);

        return redirect(route('show_tax_settlements'));
    }

    function getInvoicesForTheMonth($month, $year){

    }
}
