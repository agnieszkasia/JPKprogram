<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\TaxSettlement;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InvoiceController extends Controller{

    public function showALl(Request $request){
        $user = Auth::user();
        $invoices = $user->invoices();

        $cities = $this->getCitiesNames($invoices);

        $selectedCity = $request['cities'];

        $sortingOptions = $this->getSortingOption();

        $selectedOption = $request['sort'];

        list($startDate, $endDate, $request) = $this->setStartAndEndDate($request);

        $this->filterInvoices($invoices,$request);

        $this->sortInvoices($invoices, $request);

        $invoices = $invoices->get();


        return view('invoices.show_all', compact('invoices',
            'cities', 'startDate', 'endDate', 'selectedCity',
            'sortingOptions', 'selectedOption'));
    }

    public function getCitiesNames($invoices): array{
        $i = 0;
        $cities = array();

        foreach ($invoices->get() as $invoice){
            $cities[$i] = $invoice->city;
            $i++;
        }

        $cities = array_unique($cities);

        return $cities;
    }

    public function getSortingOption(): array{
        $sortingOption = array();

        $sortingOption[0]['value'] = 'desc_issue_date';
        $sortingOption[1]['value'] = 'asc_issue_date';
        $sortingOption[2]['value'] = 'desc_due_date';
        $sortingOption[3]['value'] = 'asc_due_date';
        $sortingOption[4]['value'] = 'desc_number';
        $sortingOption[5]['value'] = 'asc_number';
        $sortingOption[6]['value'] = 'asc_data';
        $sortingOption[7]['value'] = 'desc_data';

        $sortingOption[0]['name'] = 'Data wystawienia od najnowszych';
        $sortingOption[1]['name'] = 'Data wystawienia od najstarszych';
        $sortingOption[2]['name'] = 'Data sprzedaży od najnowszych';
        $sortingOption[3]['name'] = 'Data sprzedaży od najstarszych';
        $sortingOption[4]['name'] = 'Numer faktury od najnowszych';
        $sortingOption[5]['name'] = 'Numer faktury od najstarszych';
        $sortingOption[6]['name'] = 'Dane sprzedawcy A-Z';
        $sortingOption[7]['name'] = 'Dane sprzedawcy Z-A';

        return $sortingOption;
    }

    public function setStartAndEndDate($request): array{
        $startDate = null;
        $endDate = null;

        if ($request['start_date'] == null){
            $request['start_date'] = Auth::user()->invoices()->orderBy('issue_date')->first()->issue_date;
        } else $startDate = $request['start_date'];
        if ($request['end_date'] == null){
            $request['end_date'] = Carbon::now()->toDateString();
        } else $endDate = $request['end_date'];

        return array($startDate, $endDate, $request);
    }

    public function filterInvoices($invoices, $request){
        if (($request['start_date'] || $request['end_date']) || $request['cities']){
            if (!$request['cities']){
                $invoices->whereBetween('issue_date', [$request['start_date'], $request['end_date']]);
            } else {
                $invoices->whereBetween('issue_date', [$request['start_date'], $request['end_date']])
                    ->where('city', $request['cities']);
            }
        }
        return $invoices;
    }

    public function sortInvoices($invoices, $request){
        if ($request['sort'] == 'asc_issue_date') { $invoices->orderBy('issue_date', 'asc');}
        if ($request['sort'] == 'desc_issue_date') { $invoices->orderBy('issue_date', 'desc');}
        if ($request['sort'] == 'asc_due_date') { $invoices->orderBy('due_date', 'asc');}
        if ($request['sort'] == 'desc_due_date') { $invoices->orderBy('due_date', 'desc');}
        if ($request['sort'] == 'asc_number') { $invoices->orderBy('invoice_number', 'asc');}
        if ($request['sort'] == 'desc_number') { $invoices->orderBy('invoice_number', 'desc');}
        if ($request['sort'] == 'asc_data') { $invoices->orderBy('company', 'asc');}
        if ($request['sort'] == 'desc_data') { $invoices->orderBy('company', 'desc');}
        if ($request['sort'] == "") { $invoices->orderBy('invoice_number', 'desc');}
        return $invoices;
    }

    public function create(){
        $last_invoice = Auth::user()->invoices->last();

        if ($last_invoice->invoice_number == null) $invoice_number_temp = 1;
        else $invoice_number_temp = (int)$last_invoice->invoice_number;

        $invoice_number = ($invoice_number_temp+1)."_".Carbon::now()->year;

        $currentDate = Carbon::now()->toDateString();

        return view('invoices.create', compact('currentDate', 'invoice_number'));
    }

    public function store(Request $request){
        $user = $this->getAuthUser();

        $products = $this->getProductsToString($request);
        $prices = $this->getInvoicePrice($request);

        $this->validator($request);

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

        $user->invoices->add($invoice);

        return redirect(route('invoices'));
    }

    protected function validator($request){

        return $request->validate([
            'invoice_number' => ['required', 'string', 'max:255', 'min:1'],
            'company' => ['required', 'string', 'max:255', 'min:2'],
            'street_name' => ['required', 'string', 'min:3', 'max:255'],
            'house_number' => ['required', 'string', 'max:255'],
            'postal_code' => ['required','regex:/[0-9]{2}-[0-9]{3}/u', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'string', 'regex:/[0-9]{10}/u', 'size:10'],
            'issue_date' => ['required'],
            'due_date' => ['required'],
        ]);
    }

    public function productsValidator($request, $i){
        return $request->validate([
            'name['.$i.']' => ['required', 'string', 'max:255', 'min:1'],
            'quantity['.$i.']' => ['required', 'numeric', 'max:6'],
            'price['.$i.']' => ['required', 'numeric', 'regex:/^\d{0,8}(\.\d{1,4})?$/u', 'max:255'],
        ]);
    }


    function getProductsToString($request): string{
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

    public function getInvoicePrice($request): array{
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

        $this->validator($request);

        $invoiceDate = substr($request->input('issue_date'),0 ,-3);

        $taxSettlement = $this->checkIfIsInTaxSettlement($invoiceDate,$id);
//        dd($taxSettlement);

        if ($taxSettlement == true){
            $taxSettlementData = $this->getTaxSettlementId($invoiceDate);

            $this->updateTaxSettlement($id, $invoiceDate);

        }

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

        if(isset($taxSettlementData)){
            return redirect(route('invoices'))->with('message', $taxSettlementData);
        }

        return redirect(route('invoices'));
    }

    public function updateTaxSettlement($id, $invoiceDate){
        $oldDate = $this->getOldIssueDate($id);

        if($invoiceDate !== $oldDate){
            $taxSettlement = TaxSettlement::where('sales_invoice_ids','like', '%'.$id.'%')->first();
            if($taxSettlement != null){
                $invoicesIds = explode(';',$taxSettlement->sales_invoice_ids);
                $invoicesIds = array_diff($invoicesIds, [$id]);
                $invoicesIds = implode(';',$invoicesIds);
                $taxSettlement->update([
                    'sales_invoice_ids' => $invoicesIds
                ]);
            }

            $invoiceYear = substr($invoiceDate, 0, -3);
            $invoiceMonth = substr($invoiceDate, 5);
            $taxSettlement = TaxSettlement::where('year','like', $invoiceYear)->where('month','like', $invoiceMonth)->first();

            if($taxSettlement != null) {
                $invoicesIds = explode(';', $taxSettlement->sales_invoice_ids);
                array_push($invoicesIds, $id);
                $invoicesIds = implode(';', $invoicesIds);

                $taxSettlement->update([
                    'sales_invoice_ids' => $invoicesIds
                ]);
            }

            return null;
        }
        else return null;

    }

    public function getOldIssueDate($id){
        $oldIssueDate = Invoice::find($id)->issue_date;
        $oldIssueDate = substr($oldIssueDate,0 ,-3);

        return $oldIssueDate;
    }

    public function checkIfIsInTaxSettlement($date, $id): bool{
        $oldTaxSettlement = TaxSettlement::where('sales_invoice_ids','like', '%'.$id.'%')
            ->where('user_id', '=', Auth::id())->first();
        $month = substr($date,5,2);
        $year = substr($date,0,-3);

        $taxSettlement = TaxSettlement::where('year','like',$year)
            ->where('month','like',$month)->first();

        if (($oldTaxSettlement !=null) or ($taxSettlement != null)) return true;
        else return false;
    }

    public function getTaxSettlementId($date): int{
        $user = Auth::user();
        $taxSettlements = $user->taxSettlements;

        $month = substr($date,5,2);
        $year = substr($date,0,-3);
        $id = 0;

        foreach ($taxSettlements as $taxSettlement){
            if ($taxSettlement->month == $month && $taxSettlement->year == $year) $id=$taxSettlement->id;
        }
        return $id;
    }

    public function destroy($id){
        $taxSettlement = $this->checkIfIsInTaxSettlement(null,$id);

        if ($taxSettlement == true){
            $this->updateTaxSettlement($id, null);
        }

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
