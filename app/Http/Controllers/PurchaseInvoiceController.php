<?php

namespace App\Http\Controllers;

use App\Models\PurchaseInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseInvoiceController extends Controller{
    public function showALl(Request $request){
        $user = Auth::user();
        $invoices = $user->purchaseInvoices();

        $i = 0;
        foreach ($invoices->get() as $invoice){
            $cities[$i] = $invoice->city;
            $i++;
        }
        $selectedCity = $request['cities'];
        $startDate = null;
        $endDate = null;

        $cities = array_unique($cities);

        if (($request['start_date'] || $request['end_date']) || $request['cities']){

            if ($request['start_date'] == null){
                $request['start_date'] = $user->purchaseInvoices()->orderBy('issue_date')->first()->issue_date;
            } else $startDate = $request['start_date'];
            if ($request['end_date'] == null){
                $request['end_date'] = Carbon::now()->toDateString();
            } else $endDate = $request['end_date'];

            if (!$request['cities']){
                $invoices = $user->purchaseInvoices()
                    ->whereBetween('issue_date', [$request['start_date'], $request['end_date']]);
            } else {
                $invoices = $user->purchaseInvoices()
                    ->whereBetween('issue_date', [$request['start_date'], $request['end_date']])
                    ->where('city', $request['cities']);
//                $selectedCity = $request['cities'];
            }
        }

        if ($request['sort'] == 'asc_issue_date') { $invoices->orderBy('issue_date', 'asc');}
        if ($request['sort'] == 'desc_issue_date') { $invoices->orderBy('issue_date', 'desc');}
        if ($request['sort'] == 'asc_due_date') { $invoices->orderBy('due_date', 'asc');}
        if ($request['sort'] == 'desc_due_date') { $invoices->orderBy('due_date', 'desc');}
        if ($request['sort'] == 'asc_number') { $invoices->orderBy('invoice_number', 'asc');}
        if ($request['sort'] == 'desc_number') { $invoices->orderBy('invoice_number', 'desc');}
        if ($request['sort'] == 'asc_data') { $invoices->orderBy('company', 'asc');}
        if ($request['sort'] == 'desc_data') { $invoices->orderBy('company', 'desc');}
        if ($request['sort'] == "") { $invoices->orderBy('invoice_number', 'desc');}

        $purchaseInvoices = $invoices->get();

        return view('purchase_invoices.show_all', compact('purchaseInvoices', 'cities', 'startDate', 'endDate', 'selectedCity'));
    }

    public function create(){
        return view('purchase_invoices.create');
    }

    public function store(Request $request){

        $this->validator($request);

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
            'vat' => ['required', 'numeric', 'regex:/^\d{1,8}\.\d{1,2}$/u', 'max:255'],
            'netto' => ['required', 'numeric', 'regex:/^\d{1,8}\.\d{1,2}$/u', 'max:255'],
            'brutto' => ['required', 'numeric', 'regex:/^\d{1,8}\.\d{1,2}$/u', 'max:255'],
        ]);
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

        $this->validator($request);

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
