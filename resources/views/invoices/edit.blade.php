@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Edytuj fakture') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/invoice/'.$invoice->id.'/update')}}">
                            @csrf


                            <div class="form-group row">
                                <label for="issue_date" class="col-md-4 col-form-label text-md-right">{{ __('Data wystawienia') }}</label>

                                <div class="col-md-6">
                                    <input id="issue_date" type="date" class="form-control @error('issue_date') is-invalid @enderror" name="issue_date" value="{{ $invoice->issue_date }}" required autocomplete="issue_date" >

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
                                    <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="{{ $invoice->due_date }}" required autocomplete="due_date" >

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
                                    <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ $invoice->nip }}" required autocomplete="nip" >

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
                                    <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ $invoice->company }}" required autocomplete="company" >

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
                                    <input id="street_name" type="text" class="form-control @error('street_name') is-invalid @enderror" name="street_name" value="{{ $invoice->street_name }}" required autocomplete="address_line1" >

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
                                    <input id="house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" value="{{ $invoice->house_number }}" required autocomplete="address_line2" >

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
                                    <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ $invoice->postal_code }}" required autocomplete="postal_code" >

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
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $invoice->city }}" required autocomplete="address-level2" >

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group child-repeater-table">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Nazwa</th>
                                            <th>Ilość</th>
                                            <th>Cena jednostkowa</th>
                                            <th><a href="javascript:void(0)" class="btn btn-success addRow">+</a> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @for($i=0; $i < $productsNumber; $i++)
                                        <tr>
                                            <td><input type="text" name="name[ ]" class="form-control" value="{{$product[$i][0]}}"></td>

                                            <td><input type="text" name="quantity[ ]" class="form-control" value="{{$product[$i][1]}}"></td>
                                            <td><input type="text" name="price[ ]" class="form-control" value="{{$product[$i][2]}}"></td>
                                            <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">Usuń</a> </th>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Zapisz') }}
                                    </button>
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
