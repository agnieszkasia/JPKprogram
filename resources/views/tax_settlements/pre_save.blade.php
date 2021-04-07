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
                        <div class="mt-lg-5 col-lg-12 bg-white">

                            <div class="form-group row child-repeater-table mx-5">
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

                                    <input name="number_of_invoices" id="number_of_invoices" value="{{count($invoices_data)}}" hidden>
                                    <input name="vat" id="vat" value="{{$total_month[0]}}" hidden>

                                    @for($i=0; $i<count($invoices_data); $i++)
                                        <tr class="border-bottom">
                                            <td class="text-left">{{$invoices_data[$i]->company}}</td>
                                            <td>{{$invoices_data[$i]->nip}}</td>
                                            <td>{{$invoices_data[$i]->invoice_number}}</td>
                                            <td>{{$invoices_data[$i]->issue_date}}</td>
                                            <td>{{$invoices_data[$i]->due_date}}</td>
                                            <td>{{$invoices_data[$i]->vat}}</td>
                                            <td>{{$invoices_data[$i]->netto}}</td>
                                            <td>{{$invoices_data[$i]->brutto}}</td>
                                        </tr>
                                    @endfor
                                    <tr class="h6">
                                        <td colspan="4" ></td>
                                        <td>Suma</td>
                                        <td>{{$total_month[0]}}</td>
                                        <td>{{$total_month[1]}}</td>
                                        <td>{{$total_month[2]}}</td>
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
