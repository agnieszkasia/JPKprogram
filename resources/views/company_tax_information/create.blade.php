@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="mt-5 h3 text-center ">{{ __('Dodaj dodatkowe informacje o firmie') }}</div>
                <div class="my-5">
                    <form method="POST" action="{{ route('store_tax_settlement') }}" id="repeater_form">
                        @csrf
                        <div class="row mx-5">

                            <div class="col-lg-6">

                                <div class="h5 mt-4">Tryb rozliczenia:</div>
                                {{--Tryb rozliczenia--}}
                                <div class="row">
                                    <div class="col">
                                        <input id="settlement_form" type="radio" name="settlement_form" value="JPK_V7M" checked ><label for="settlement_form" class="col-form-label ml-2"> Miesięczny</label>
                                    </div>
                                    <div class="col">
                                        <input id="settlement_form2" type="radio" name="settlement_form" value="JPK_V7K" ><label for="settlement_form2" class="col-form-label ml-2"> Kwartalny</label>
                                    </div>
                                </div>

                                <div class="h5 mt-4">Podmiot:</div>
                                {{--Podmiot--}}
                                <div class="row">
                                    <div class="col">
                                        <input id="entity_type" type="radio" name="entity_type" value="1" checked ><label for="entity_type" class="col-form-label ml-2">Osoba fizyczna</label>
                                    </div>
                                    <div class="col">
                                        <input id="entity_type2" type="radio" name="entity_type" value="2" ><label for="entity_type2" class="col-form-label ml-2">Osoba niefizyczna</label>
                                    </div>
                                </div>




                                {{-- NIP --}}
                                <div class="h5 mt-4">Kod urzędu:</div>
                                <div class="row mt-lg-4">
                                    <div class="col-sm-12">
                                        <input id="office_code" type="text" class="form-control @error('office_code') is-invalid @enderror" name="office_code" value="{{ old('office_code') }}"  placeholder="KOD URZĘDU" required autocomplete="office_code" >

                                        @error('nip')
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
