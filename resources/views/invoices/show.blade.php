@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="mt-5 h3 text-center ">{{ __('Faktura nr: ') }} {{$invoice->invoice_number}}</div>
                    <div class="container-fluid mt-3 d-flex justify-content-end">
                        <a href="{{ url('/invoice/'.$invoice->id.'/pdf') }}" class="btn btn-dark" role="button" aria-pressed="true">Generuj PDF</a>
                    </div>

                    <div class="my-5">
                        <div class="row mx-5">
                            <div class="col-lg-4">
                                <div class="h5">Dane nabywcy:</div>
                                {{--Nazwa firmy--}}
                                <div class="row mt-lg-2">
                                    <div class="col-sm-12">{{ $invoice->company}}
                                    </div>
                                    {{--Ulica--}}
                                    <div class="col-sm-8">
                                        {{ $invoice->street_name }} {{ $invoice->house_number }}
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $invoice->city }} {{ $invoice->postal_code }}
                                    </div>

                                    <div class="col-sm-12">
                                        NIP: {{ $invoice->nip }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="h5">Dane sprzedawcy:</div>
                                {{--Nazwa firmy--}}
                                <div class="row mt-lg-2">
                                    <div class="col-sm-12">{{ $user->company}}
                                    </div>
                                    {{--Ulica--}}
                                    <div class="col-sm-8">
                                        {{ $user->street_name }} {{ $user->house_number }}
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $user->city }} {{ $user->postal_code }}
                                    </div>

                                    <div class="col-sm-12">
                                        NIP: {{ $user->nip }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 text-left">

                                {{--Data wystawienia--}}

                                    <div class="col-sm-12 h5">
                                        {{ __('Data wystawienia:') }}
                                    </div>
                                    <div class="col-sm-12">
                                        {{ $invoice->issue_date }}
                                    </div>

                                    <div class="col-sm-12 h5 mt-2">
                                        {{ __('Data sprzedaży:') }}
                                    </div>
                                    <div class="col-sm-12">
                                        {{ $invoice->due_date }}
                                    </div>
                            </div>
                        </div>

                        <div class="mt-lg-5 col-lg-12 bg-white">

                            <div class="form-group row child-repeater-table mx-5">
                                <table class="table table-borderless table-responsive">
                                    <thead>
                                    <tr class="border-bottom text-right">
                                        <th class="col-1 h5 text-left">Nazwa produktu/usługi</th>
                                        <th class="col-md-2 h6">Ilość</th>
                                        <th class="col-md-2 h6" >Cena jednostkowa</th>
                                        <th class="col-md-2 h6" >Netto</th>
                                        <th class="col-md-2 h6" >VAT</th>
                                        <th class="col-md-2 h6" >Brutto</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-right">
                                    @for($i=0; $i < $productsNumber; $i++)
                                        <tr class="border-bottom">
                                            <td class="text-left">{{$product[$i][0]}}</td>
                                            <td>{{$product[$i][1]}}</td>
                                            <td>{{$product[$i][2]}}</td>
                                            <td>{{$product[$i][3]}}</td>
                                            <td>{{$product[$i][4]}}</td>
                                            <td>{{$product[$i][5]}}</td>
                                        </tr>
                                    @endfor
                                    <tr class="h5">
                                        <td colspan="2" ></td>
                                        <td>Suma</td>
                                        <td>{{$invoice->netto}}</td>
                                        <td>{{$invoice->vat}}</td>
                                        <td>{{$invoice->brutto}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
