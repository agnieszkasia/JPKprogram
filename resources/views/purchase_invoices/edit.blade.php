@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="mt-5 h3 text-center ">{{ __('Edytuj fakturę zakupu') }}</div>

                    <div class="my-5">
                        <form method="POST" action="{{ url('/purchaseinvoice/'.$purchaseInvoice->id.'/update')}}">
                            @csrf
                            <div class="row mx-5">
                                <div class="col-lg-6">
                                    <div class="h5">Dane sprzedawcy:</div>
                                    {{--Nazwa firmy--}}
                                    <div class="row mt-lg-4">
                                        <div class="col">
                                            <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ $purchaseInvoice->company }}" placeholder="Nazwa firmy" required autocomplete="company" >

                                            @error('company')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-lg-4">
                                        {{--Ulica--}}
                                        <div class="col-sm-8">
                                            <input id="street_name" type="text" class="form-control @error('street_name') is-invalid @enderror" name="street_name" value="{{ $purchaseInvoice->street_name }}" placeholder="Ulica" required autocomplete="address_line1" >

                                            @error('street_name')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        {{--numer budynku--}}
                                        <div class="col-sm-4">
                                            <input id="house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" value="{{ $purchaseInvoice->house_number }}" placeholder="Numer budynku" required autocomplete="address_line2" >

                                            @error('house_number')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mt-lg-4">
                                        {{--Miasto--}}
                                        <div class="col-sm-8">
                                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $purchaseInvoice->city }}" placeholder="Miasto" required autocomplete="address-level2" >

                                            @error('city')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                        {{--Kod pocztowy--}}
                                        <div class="col-sm-4">
                                            <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ $purchaseInvoice->postal_code }}" placeholder="Kod pocztowy" required autocomplete="postal_code" >

                                            @error('postal_code')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- NIP --}}
                                    <div class="row mt-lg-4">
                                        <div class="col-sm-12">
                                            <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ $purchaseInvoice->nip }}"  placeholder="NIP" required autocomplete="nip" >

                                            @error('nip')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 ">

                                    {{--Numer faktury--}}
                                    <div class="row mt-lg-5">
                                        <div class="col-sm-5 offset-sm-2 h5 text-right">
                                            <label for="invoice_number" class="col-form-label text-md-right">{{ __('Numer faktury') }}</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="invoice_number" type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ $purchaseInvoice->invoice_number }}" required>

                                            @error('invoice_number')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{--Data wystawienia--}}
                                    <div class="row mt-lg-2">
                                        <div class=" offset-sm-1 col-sm-6 h5 text-right">
                                            <label for="issue_date" class="col-form-label text-md-right">{{ __('Data wystawienia') }}</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="issue_date" type="date" class="form-control @error('issue_date') is-invalid @enderror" name="issue_date" value="{{ $purchaseInvoice->issue_date }}" required autocomplete="issue_date" >

                                            @error('issue_date')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{--Data sprzedazy--}}
                                    <div class="row  mt-lg-2">
                                        <div class="col-sm-5 offset-sm-2 h5 text-right">
                                            <label for="due_date" class="col-form-label text-md-right">{{ __('Data sprzedaży') }}</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ $purchaseInvoice->due_date }}" required autocomplete="due_date" >

                                            @error('due_date')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            <div class="col-lg-12 mt-lg-4">

                                <div class="row mt-lg-4">


                                    <div class="col-sm-3">
                                        <div class="h5 mt-lg-2">Kwota całkowita:</div>
                                    </div>

                                    {{--Wartość VAT--}}
                                    <div class="col-sm-3">
                                        <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ $purchaseInvoice->vat }}" placeholder="VAT" required >

                                        @error('vat')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    {{-- Netto --}}
                                    <div class="col-sm-3">
                                        <input id="netto" type="text" class="form-control @error('netto') is-invalid @enderror" name="netto" value="{{ $purchaseInvoice->netto }}" placeholder="Netto" required>
                                        @error('netto')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    {{-- Brutto --}}
                                    <div class="col-sm-3">
                                        <input id="brutto" type="text" class="form-control @error('brutto') is-invalid @enderror" name="brutto" value="{{ $purchaseInvoice->brutto }}" placeholder="Brutto" required>

                                        @error('brutto')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 mb-0 justify-content-end mt-3">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Zapisz') }}
                                    </button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>

        $('thead').on('click', '.addRow', function (){
            var tr = "<tr id='group[ ]'>" +
                "<td><input type='text' name='name[ ]' class='form-control'></td>" +
                "<td><input type='text' name='quantity[ ]' class='form-control'></td>" +
                "<td><input type='text' name='price[ ]' class='form-control'></td>" +
                "<th><a href='javascript:void(0)' class='btn btn-danger deleteRow'>Usuń</a> </th>" +
                "</tr>"

            $('tbody').append(tr);
        });

        $('tbody').on('click', '.deleteRow', function (){
            $(this).parent().parent().remove();
        })
    </script>
@endsection
