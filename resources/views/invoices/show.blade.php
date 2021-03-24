@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="mt-5 h3 text-center ">{{ __('Faktura nr: ') }} {{$invoice->invoice_number}}</div>

                    <div class="my-5">
                        <form method="POST" action="{{ url('/invoice/'.$invoice->id.'/update')}}">
                            @csrf
                            <div class="row mx-5">
                                <div class="col-lg-4">
                                    <div class="h5">Dane nabywcy:</div>
                                    {{--Nazwa firmy--}}
                                    <div class="row mt-lg-4">
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
                                            {{ $invoice->nip }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="h5">Dane sprzedawcy:</div>
                                    {{--Nazwa firmy--}}
                                    <div class="row mt-lg-4">
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
                                            {{ $user->nip }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 mt-4 ">

                                    {{--Data wystawienia--}}
                                    <div class="row mt-lg-2">

                                        <div class="col-sm-7 h6 text-right">
                                            <label for="issue_date" class="col-form-label text-md-right">{{ __('Data wystawienia') }}</label>
                                        </div>
                                        <div class="col-sm-5 mt-2">
                                            {{ $invoice->issue_date }}
                                        </div>

                                        <div class="col-sm-7 h6 text-right">
                                            <label for="due_date" class="col-form-label text-md-right">{{ __('Data sprzedaży') }}</label>
                                        </div>
                                        <div class="col-sm-5 mt-2">
                                            {{ $invoice->due_date }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-lg-4 col-lg-12 bg-white">

                                <div class="form-group row child-repeater-table mx-5">
                                    <table class="table table-borderless table-responsive">
                                        <thead>
                                        <tr class="border-bottom">
                                            <th class="col-1 h5">Nazwa produktu/usługi</th>
                                            <th class="col-md-2 h6">Ilość</th>
                                            <th class="col-md-2 h6" >Cena jednostkowa</th>
                                            <th class="col-md-2 h6" >Netto</th>
                                            <th class="col-md-2 h6" >VAT</th>
                                            <th class="col-md-2 h6" >Brutto</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for($i=0; $i < $productsNumber; $i++)
                                            <tr class="border-bottom">
                                                <td>{{$product[$i][0]}}</td>
                                                <td>{{$product[$i][1]}}</td>
                                                <td>{{$product[$i][2]}}</td>
                                                <td>{{$product[$i][3]}}</td>
                                                <td>{{$product[$i][4]}}</td>
                                                <td>{{$product[$i][5]}}</td>
                                            </tr>
                                        @endfor
                                        <tr>
                                            <td colspan="2 h6"></td>
                                            <th class="text-right">Suma</th>
                                            <th>{{$all_products_price[0]}}</th>
                                            <th>{{$all_products_price[1]}}</th>
                                            <th>{{$all_products_price[2]}}</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
