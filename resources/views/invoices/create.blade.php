@extends('layouts.app')

@section('head_content')
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="{{ asset('js/repeater.js') }}" defer></script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dodaj fakturę') }}</div>

                    <div class="card-body">
                        <form method="POST"  action="{{ route('store_invoice') }}" id="repeater_form">
                            @csrf

                            <div class="form-group row">
                                <label for="issue_date" class="col-md-4 col-form-label text-md-right">{{ __('Data wystawienia') }}</label>

                                <div class="col-md-6">
                                    <input id="issue_date" type="date" class="form-control @error('issue_date') is-invalid @enderror" name="issue_date" value="{{ $currentDate }}" required autocomplete="issue_date" >

                                    @error('issue_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="due_date" class="col-md-4 col-form-label text-md-right">{{ __('Data sprzedaży') }}</label>

                                <div class="col-md-6">
                                    <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ $currentDate }}" required autocomplete="due_date" >

                                    @error('due_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('NIP') }}</label>

                                <div class="col-md-6">
                                    <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required autocomplete="nip" >

                                    @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa firmy') }}</label>

                                <div class="col-md-6">
                                    <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" required autocomplete="company" >

                                    @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street_name" class="col-md-4 col-form-label text-md-right">{{ __('Ulica') }}</label>

                                <div class="col-md-6">
                                    <input id="street_name" type="text" class="form-control @error('street_name') is-invalid @enderror" name="street_name" value="{{ old('street_name') }}" required autocomplete="address_line1" >

                                    @error('street_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="house_number" class="col-md-4 col-form-label text-md-right">{{ __('Numer budynku') }}</label>

                                <div class="col-md-6">
                                    <input id="house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" value="{{ old('house_number') }}" required autocomplete="address_line2" >

                                    @error('house_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="postal_code" class="col-md-4 col-form-label text-md-right">{{ __('Kod pocztowy') }}</label>

                                <div class="col-md-6">
                                    <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code" >

                                    @error('post_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Miasto') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="address-level2" >

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row child-repeater-table">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="col-1">Nazwa</th>
                                        <th class="col-md-2">Ilość</th>
                                        <th class="col-md-2" >Cena jednostkowa</th>
                                        <th><a href="javascript:void(0)" class="btn btn-success addRow">+</a> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" name="name[ ]" class="form-control"></td>
                                        <td><input type="text" name="quantity[ ]" class="form-control"></td>
                                        <td><input type="text" name="price[ ]" class="form-control"></td>
                                        <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">Usuń</a> </th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>


                            <div class="form-group mb-0">
                                <div class="text-right mt-3">
                                    <input  type="submit" class="btn btn-dark" value="Zapisz">
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
