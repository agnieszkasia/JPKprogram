@extends('layouts.app')

@section('content')
    <div class="mt-5 h3 text-center ">DODAJ ROZLICZENIE</div>
    <div class="my-5">
        <form method="POST" action="{{ route('generate_tax_settlement') }}" id="repeater_form">
            @csrf
            <div class="row mx-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="mt-lg-4">
                        <label for="period" class="col-form-label h2">Okres rozliczeniowy</label>
                        <select class="form-control input-group-sm" name="period" id="period">
                            <option value="">Wybierz...</option>
                            @foreach($years as $year)
                                <optgroup label="{{$year}}">
                                    @foreach($months[$year] as $month)
                                        <option value="{{$year}}-{{$month}}">{{$month}}</option>
                                    @endforeach
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mb-0 justify-content-end ">
                        <div class="text-right mt-3 ">
                            <input  type="submit" class="btn btn-dark" value="Dalej">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
