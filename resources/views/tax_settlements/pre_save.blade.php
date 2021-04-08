@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="mt-5 h3 text-center ">{{ __('Dodaj rozliczenie') }}</div>
                <div class="my-5">
                    <form method="POST" action="{{ route('store_tax_settlement') }}" id="repeater_form">
                        @csrf
                        <div class="row mx-5 justify-content-center">
                            <div class="col-lg-6">
                                <div class="row mt-lg-4">
                                    <div class="col-sm-4 text-md-right">Okres rozliczeniowy</div>
                                    <input class="col-sm-8 form-control no-border" name="period" id="period" value="{{$period}}">
                                </div>
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

                                    <input name="number_of_sale_invoices" id="number_of_sale_invoices" value="{{count($invoicesData)}}" hidden>
                                    <input name="sale_vat" id="sale_vat" value="{{$totalMonthlySalesValues['vat']}}" hidden>
                                    <input name="sale_brutto" id="sale_brutto" value="{{$totalMonthlySalesValues['brutto']}}" hidden>

                                    @for($i=0; $i<count($invoicesData); $i++)
                                        <input name="sale_invoice_ids[{{$i}}]" id="sale_invoice_ids[{{$i}}]" value="{{$invoicesData[$i]->id}}" hidden>

                                        <tr class="border-bottom">
                                            <td class="text-left">{{$invoicesData[$i]->company}}</td>
                                            <td>{{$invoicesData[$i]->nip}}</td>
                                            <td>{{$invoicesData[$i]->invoice_number}}</td>
                                            <td>{{$invoicesData[$i]->issue_date}}</td>
                                            <td>{{$invoicesData[$i]->due_date}}</td>
                                            <td>{{$invoicesData[$i]->vat}}</td>
                                            <td>{{$invoicesData[$i]->netto}}</td>
                                            <td>{{$invoicesData[$i]->brutto}}</td>
                                        </tr>
                                    @endfor
                                    <tr class="h6">
                                        <td colspan="4" ></td>
                                        <td>Suma</td>
                                        <td>{{$totalMonthlySalesValues['vat']}}</td>
                                        <td>{{$totalMonthlySalesValues['netto']}}</td>
                                        <td>{{$totalMonthlySalesValues['brutto']}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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

                                    <input name="number_of_purchase_invoices" id="number_of_purchase_invoices" value="{{count($purchaseInvoicesData)}}" hidden>
                                    <input name="purchase_vat" id="purchase_vat" value="{{$totalMonthlyPurchaseValues['vat']}}" hidden>
                                    <input name="purchase_brutto" id="purchase_brutto" value="{{$totalMonthlyPurchaseValues['brutto']}}" hidden>

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
                                        <td>{{$totalMonthlyPurchaseValues['vat']}}</td>
                                        <td>{{$totalMonthlyPurchaseValues['netto']}}</td>
                                        <td>{{$totalMonthlyPurchaseValues['brutto']}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="col-md-12 mb-0 justify-content-between d-flex">
                            <div class="text-right mt-3 ">
                                <a href="{{url()->previous()}}" class="btn btn-dark" >Wstecz</a>
                            </div>
                            <div class="text-right mt-3 ">
                                <input  type="submit" class="btn btn-dark" value="Zapisz">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
