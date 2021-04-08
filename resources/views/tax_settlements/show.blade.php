@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="mt-5 h3 text-center ">{{ __('Rozliczenie') }}</div>
                <div class="mb-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 ">
                                    <div class="text-center h5">Okres rozliczeniowy : {{$taxSettlement->year}}-{{$taxSettlement->month}}</div>
                            </div>
                        </div>
                        <div class="co h4 ml-lg-5 mt-lg-5">Sprzedaż</div>
                        <div class=" col-lg-12 bg-white">

                            <div class="form-group mx-5">
                                <table class="table table-borderless table-responsive">
                                    <thead>
                                    <tr class="border-bottom text-right">
                                        <th class="col-md-2 h6 text-left">Nazwa Kontrahenta</th>
                                        <th class="col-md-2 h6">Numer kontrahenta</th>
                                        <th class="col-md-2 h6" >Dowód sprzedaży</th>
                                        <th class="col-md-2 h6" >Data wystawienia</th>
                                        <th class="col-md-2 h6" >Data sprzedaży</th>
                                        <th class="col-md-1 h6" >VAT</th>
                                        <th class="col-md-1 h6" >Netto</th>
                                        <th class="col-md-1 h6" >Brutto</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-right h7">

                                    @for($i=0; $i<count($salesInvoicesData); $i++)
                                        <input name="sale_invoice_ids[{{$i}}]" id="sale_invoice_ids[{{$i}}]" value="{{$salesInvoicesData[$i]->id}}" hidden>

                                        <tr class="border-bottom">
                                            <td class="text-left">{{$salesInvoicesData[$i]->company}}</td>
                                            <td>{{$salesInvoicesData[$i]->nip}}</td>
                                            <td>{{$salesInvoicesData[$i]->invoice_number}}</td>
                                            <td>{{$salesInvoicesData[$i]->issue_date}}</td>
                                            <td>{{$salesInvoicesData[$i]->due_date}}</td>
                                            <td>{{$salesInvoicesData[$i]->vat}}</td>
                                            <td>{{$salesInvoicesData[$i]->netto}}</td>
                                            <td>{{$salesInvoicesData[$i]->brutto}}</td>
                                        </tr>
                                    @endfor
                                    <tr class="h6">
                                        <td colspan="4" ></td>
                                        <td>Suma</td>
                                        <td>{{$taxSettlement->sale_vat}}</td>
                                        <td>{{($taxSettlement->sale_brutto - $taxSettlement->sale_vat)}}</td>
                                        <td>{{$taxSettlement->sale_brutto}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @if(count($purchaseInvoicesData) == '0')

                        <div class="co h4 ml-lg-5 mt-lg-5">Zakupy</div>

                        <div class="col-lg-12 bg-white">

                            <div class="form-group mx-5">
                                <table class="table table-borderless table-responsive">
                                    <thead>
                                    <tr class="border-bottom text-right">
                                        <th class="col-md-2 h6 text-left">Nazwa sprzedawcy</th>
                                        <th class="col-md-2 h6">Numer sprzedawcy</th>
                                        <th class="col-md-2 h6" >Dowód sprzedaży</th>
                                        <th class="col-md-2 h6" >Data wystawienia</th>
                                        <th class="col-md-2 h6" >Data sprzedaży</th>
                                        <th class="col-md-1 h6" >VAT</th>
                                        <th class="col-md-1 h6" >Netto</th>
                                        <th class="col-md-1 h6" >Brutto</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-right h7">

                                        @for($i=0; $i<count($purchaseInvoicesData); $i++)

                                            <tr class="border-bottom">
                                                <input name="purchase_invoice_ids[{{$i}}]" id="purchase_invoice_ids[{{$i}}]" value="{{$purchaseInvoicesData[$i]->id}}" hidden>

                                                <td class="text-left">{{$purchaseInvoicesData[$i]->company}}</td>
                                                <td>{{$purchaseInvoicesData[$i]->nip}}</td>
                                                <td>{{$purchaseInvoicesData[$i]->invoice_number}}</td>
                                                <td>{{$purchaseInvoicesData[$i]->issue_date}}</td>
                                                <td>{{$purchaseInvoicesData[$i]->due_date}}</td>
                                                <td>{{$purchaseInvoicesData[$i]->vat}}</td>
                                                <td>{{$purchaseInvoicesData[$i]->netto}}</td>
                                                <td>{{$purchaseInvoicesData[$i]->brutto}}</td>
                                            </tr>
                                        @endfor
                                    <tr class="h6">
                                        <td colspan="4" ></td>
                                        <td>Suma</td>
                                        <td>{{$taxSettlement->purchase_vat}}</td>
                                        <td>{{($taxSettlement->purchase_brutto - $taxSettlement->purchase_vat)}}</td>
                                        <td>{{$taxSettlement->purchase_brutto}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                @endif

            </div>
        </div>
    </div>

@endsection
