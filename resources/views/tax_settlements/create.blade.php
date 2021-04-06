@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="mt-5 h3 text-center ">{{ __('Dodaj rozliczenie') }}</div>
                <div class="my-5">
                    <form method="POST" action="{{ route('store_tax_settlement') }}" id="repeater_form">
                        @csrf
                        <div class="row mx-5">

                            <div class="col-lg-6">

                                <div class="h5 mt-4">Tryb rozliczenia:</div>
                                {{--Tryb rozliczenia--}}
                                <div class="row">
                                    <div class="col">
                                        <input id="form_type" type="radio" name="form_type" value="JPK_V7M" checked ><label for="form_type" class="col-form-label ml-2"> Miesięczny</label>
                                    </div>
                                    <div class="col">
                                        <input id="form_type2" type="radio" name="form_type" value="JPK_V7K" ><label for="form_type2" class="col-form-label ml-2"> Kwartalny</label>
                                    </div>
                                </div>

                                <div class="h5 mt-4">Cel złożenia:</div>
                                {{--Cel złożenia--}}
                                <div class="row">
                                    <div class="col">
                                        <input id="purpose_of_submission" type="radio" name="form_type" value="1" checked ><label for="purpose_of_submission" class="col-form-label ml-2"> Złożenie po raz pierwszy</label>
                                    </div>
                                    <div class="col">
                                        <input id="purpose_of_submission2" type="radio" name="form_type" value="2" ><label for="purpose_of_submission2" class="col-form-label ml-2"> Korekta</label>
                                    </div>
                                </div>

                                <div class="h5 mt-4 flex-column">Elementy struktury:</div>
                                {{--Elementy struktury--}}
                                <div class=" ">
                                    <div class="">
                                        <input id="structure_elements" type="radio" name="form_type" value="1" checked ><label for="structure_elements" class="col-form-label ml-2">Ewidencja, deklaracja</label>
                                    </div>
                                    <div class="">
                                        <input id="structure_elements2" type="radio" name="form_type" value="2" ><label for="structure_elements2" class="col-form-label ml-2">Ewidencja</label>
                                    </div>
                                    <div class="">
                                        <input id="structure_elements3" type="radio" name="form_type" value="3" ><label for="structure_elements3" class="col-form-label ml-2">Deklaracja</label>
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
                                        <input id="invoice_number" type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" value="" required>

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
                                        <input id="issue_date" type="date" class="form-control @error('issue_date') is-invalid @enderror" name="issue_date" value="" required autocomplete="issue_date" >

                                        @error('issue_date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Data sprzedarzy--}}
                                <div class="row  mt-lg-2">
                                    <div class="col-sm-5 offset-sm-2 h5 text-right">
                                        <label for="due_date" class="col-form-label text-md-right">{{ __('Data sprzedaży') }}</label>
                                    </div>
                                    <div class="col-sm-5">
                                        <input id="due_date" type="date" class="form-control @error('due_date') is-invalid @enderror" name="due_date" value="" required autocomplete="due_date" >

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
                                        <th class="col-1 h5">Nazwa produktu/usługi</th>
                                        <th class="col-md-2 h5">Ilość</th>
                                        <th class="col-md-2 h5" >Cena jednostkowa</th>
                                        <th><a href="javascript:void(0)" class="btn btn-success addRow">+</a> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="text" name="name[ ]" class="form-control" autocomplete=""></td>
                                        <td><input type="text" name="quantity[ ]" class="form-control"></td>
                                        <td><input type="text" name="price[ ]" class="form-control"></td>
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
