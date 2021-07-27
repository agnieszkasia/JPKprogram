@extends('layouts.app')

@section('content')
    <div class="mt-5 h3 text-center ">DODAJ FAKTURĘ</div>
    <div class="my-5">
        <form method="POST" action="{{ route('store_invoice') }}" id="repeater_form">
            @csrf
            <div class="row mx-5">

                <div class="col-lg-6">

                    <div class="h5">Dane nabywcy:</div>
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

                <div class="col-lg-6 ">

                    {{--Numer faktury--}}
                    <div class="row mt-lg-5">
                        <div class="col-sm-5 offset-sm-2 h5 text-right">
                            <label for="invoice_number" class="col-form-label text-md-right">{{ __('Numer faktury') }}</label>
                        </div>
                        <div class="col-sm-5">
                            <input id="invoice_number" type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="{{ $invoice_number }}" required>

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
                            <input id="issue_date" type="date" class="form-control @error('issue_date') is-invalid @enderror" name="issue_date" value="{{ $currentDate }}" required autocomplete="issue_date" >

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
                            <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ $currentDate }}" required autocomplete="due_date" >

                            @error('due_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-lg-4 col-lg-12 bg-white">
                {{--Pozycje faktury--}}
                <div class="form-group row child-repeater-table mx-5">
                    <table class="table table-borderless table-responsive">
                        <thead>
                        <tr>
                            <th class="col-7 h5">Nazwa produktu/usługi</th>
                            <th class="col-md-2 h5">Ilość</th>
                            <th class="col-md-2 h5" >Cena jednostkowa</th>
                            <th><a href="javascript:void(0)" class="btn btn-success addRow">+</a> </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input type="text" name="name[ ]" class="form-control @error('name[ ]') is-invalid @enderror" autocomplete="">

                                @error('name[ ]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="quantity[ ]" class="form-control @error('quantity[ ]') is-invalid @enderror">

                                @error('quantity[ ]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                            <td>
                                <input type="text" name="price[ ]" class="form-control @error('price[ ]') is-invalid @enderror">

                                @error('price[ ]')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </td>
                            <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">Usuń</a> </th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="col-md-12 mb-0 justify-content-end ">
                <div class="text-right mt-3 ">
                    <input  type="submit" class="btn btn-dark" value="Zapisz">
                </div>
            </div>
        </form>
    </div>


@endsection
