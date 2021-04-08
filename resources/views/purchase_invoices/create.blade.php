@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="mt-5 h3 text-center ">{{ __('Dodaj fakturę zakupu') }}</div>
                <div class="my-5">
                    <form method="POST" action="{{ route('store_purchase_invoice') }}" id="repeater_form">
                        @csrf
                        <div class="row mx-5">

                            <div class="col-lg-6">

                                <div class="h5">Dane sprzedawcy:</div>
                                {{--Nazwa firmy--}}
                                <div class="row mt-lg-4">
                                    <div class="col">
                                        <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" placeholder="Nazwa firmy" required autocomplete="company" >

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
                                        <input id="street_name" type="text" class="form-control @error('street_name') is-invalid @enderror" name="street_name" value="{{ old('street_name') }}" placeholder="Ulica" required autocomplete="address_line1" >

                                        @error('street_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    {{--numer budynku--}}
                                    <div class="col-sm-4">
                                        <input id="house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" value="{{ old('house_number') }}" placeholder="Numer budynku" required autocomplete="address_line2" >

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
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="Miasto" required autocomplete="address-level2" >

                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    {{--Kod pocztowy--}}
                                    <div class="col-sm-4">
                                        <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" placeholder="Kod pocztowy" required autocomplete="postal_code" >

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
                                        <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}"  placeholder="NIP" required autocomplete="nip" >

                                        @error('nip')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 offset-lg-1 ">

                                <div class="h5">Dane faktury:</div>

                                {{--Numer faktury--}}
                                <div class="row mt-lg-4">
                                    <div class="col">
                                        <input id="invoice_number" type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ old('invoice_number') }}" placeholder="Numer faktury" required >

                                        @error('invoice_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Data wystawienia--}}
                                <div class="h5 mt-lg-4">Data wystawienia:</div>
                                <div class="row ">
                                    <div class="col">
                                        <input id="issue_date" type="date" class="form-control @error('issue_date') is-invalid @enderror" name="issue_date" value="{{ old('issue_date') }}" placeholder="123" required >

                                        @error('issue_date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Data sprzedazy--}}
                                <div class="h5 mt-lg-4">Data sprzedaży:</div>
                                <div class="row ">
                                    <div class="col">
                                        <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ old('due_date') }}" required>

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

                                    <div class="col-sm-3 text-right">
                                        <div class="h5 mt-lg-2">Kwota całkowita:</div>
                                    </div>

                                    {{--Wartość VAT--}}
                                    <div class="col-sm-3">
                                        <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ old('vat') }}" placeholder="VAT" required >

                                        @error('vat')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    {{-- Netto --}}
                                    <div class="col-sm-3">
                                        <input id="netto" type="text" class="form-control @error('netto') is-invalid @enderror" name="netto" value="{{ old('netto') }}" placeholder="Netto" required>

                                        @error('netto')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    {{-- Brutto --}}
                                    <div class="col-sm-3">
                                        <input id="brutto" type="text" class="form-control @error('brutto') is-invalid @enderror" name="brutto" value="{{ old('brutto') }}" placeholder="Brutto" required>

                                        @error('brutto')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12 mb-0 justify-content-end ">
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
