@extends('layouts.app')

@section('content')
    <div class="mt-5 h3 text-center ">Faktura nr: {{$purchaseInvoice->invoice_number}}</div>

    <div class="my-5">
        <div class="row mx-5">
            <div class="col-lg-4">
                <div class="h5">Dane sprzedawcy:</div>
                {{--Nazwa firmy--}}
                <div class="row mt-lg-2">
                    <div class="col-sm-12">{{ $purchaseInvoice->company}}
                    </div>
                    {{--Ulica--}}
                    <div class="col-sm-8">
                        {{ $purchaseInvoice->street_name }} {{ $purchaseInvoice->house_number }}
                    </div>
                    <div class="col-sm-8">
                        {{ $purchaseInvoice->city }} {{ $purchaseInvoice->postal_code }}
                    </div>

                    <div class="col-sm-12">
                        NIP: {{ $purchaseInvoice->nip }}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="h5">Dane nabywcy:</div>
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
                    {{ $purchaseInvoice->issue_date }}
                </div>

                <div class="col-sm-12 h5 mt-2">
                    {{ __('Data sprzedaży:') }}
                </div>
                <div class="col-sm-12">
                    {{ $purchaseInvoice->due_date }}
                </div>
            </div>
        </div>

        <div class="mt-lg-4 border-top ">

            <div class="row mt-3 col-lg-10 justify-content-end">
                <div class="h5 mt-2 col-sm-2 text-right">VAT:</div>
                <div class="col-sm-2 form-control">{{ $purchaseInvoice->vat }} zł</div>
            </div>

            <div class="row mt-3 col-lg-10 justify-content-end">
                <div class="h5 mt-2 col-sm-2 text-right ">Netto:</div>
                <div class="col-sm-2 form-control">{{ $purchaseInvoice->netto }} zł</div>
            </div>

            <div class="row mt-3 col-lg-10 justify-content-end">
                <div class="h5 mt-2 col-sm-2 text-right">Brutto:</div>
                <div class="col-sm-2 form-control">{{ $purchaseInvoice->brutto }} zł</div>
            </div>

        </div>
    </div>

@endsection
