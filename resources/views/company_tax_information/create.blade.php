@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="mt-5 h3 text-center ">{{ __('Dodaj dodatkowe informacje o firmie') }}</div>
                <div class="my-5">

                    <form method="POST" action="{{ route('store_company_tax_information') }}" id="repeater_form">
                        @csrf
                        <div class="row mx-5">

                            <div class="col-lg-6">

                                <div class="h5 mt-4">Tryb rozliczenia:</div>
                                {{-- Input -Tryb rozliczenia--}}
                                <div class="row">
                                    <div class="col">
                                        <input id="settlement_form" type="radio" name="settlement_form" value="JPK_V7M" checked ><label for="settlement_form" class="col-form-label ml-2"> Miesięczny</label>
                                    </div>
                                    <div class="col">
                                        <input id="settlement_form2" type="radio" name="settlement_form" value="JPK_V7K" ><label for="settlement_form2" class="col-form-label ml-2"> Kwartalny</label>
                                    </div>
                                </div>

                                <div class="h5 mt-4">Podmiot:</div>
                                {{-- Input - Podmiot--}}
                                <div class="row">
                                    <div class="col">
                                        <input id="entity_type" type="radio" name="entity_type" value="1" checked ><label for="entity_type" class="col-form-label ml-2">Osoba fizyczna</label>
                                    </div>
                                    <div class="col">
                                        <input id="entity_type2" type="radio" name="entity_type" value="2" ><label for="entity_type2" class="col-form-label ml-2">Osoba niefizyczna</label>
                                    </div>
                                </div>

                                {{-- Select - Kod urzedu --}}
                                <div class="h5 mt-4">Kod urzędu:</div>
                                <div class="row">
                                    <div class="col">
                                        <input list="office_codes" class="form-control select" id="office_code" name="office_code" placeholder="Wybierz...">
                                        <datalist id="office_codes">
{{--                                            <option value="" class="dropdown-item">Wybierz...</option>--}}
                                            @for($i=0; $i<$lineCount; $i++)
                                                <option value="{{ $data[$i] }}" class="form-control">
                                            @endfor
                                        </datalist>
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Button --}}
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
    $(document).ready(function () {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>

@endsection
