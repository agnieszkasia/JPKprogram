@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">

                <div class="mt-5 h3 text-center ">{{ __('ROZLICZENIA') }}</div>
                <div class="d-flex container-fluid justify-content-end">
                    <div class="mt-3 d-flex mr-3">
                        <a href="{{ route('create_tax_settlement') }}" class="btn btn-dark" role="button" aria-pressed="true">Utwórz rozliczenie</a>
                    </div>

                    @if($taxSettlements != null)
                        <div class="mt-3 d-flex ">
                            <a href="{{ route('create_tax_correction') }}" class="btn btn-dark" role="button" aria-pressed="true">Utwórz korekte</a>
                        </div>
                    @endif

                </div>

                <div class="card-body">
                    <div class="container-xl">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @for($i=0; $i<count($taxSettlements); $i++)
                                <div class="mb-3 d-flex justify-content-between border-top">
                                    <div class="flex-column mt-3">
{{--                                        <div class="h5">{{$taxSettlements[$i]->company}}</div>--}}
                                        <div class="h5">Okres rozliczeniowy: {{$taxSettlements[$i]->year}}-{{$taxSettlements[$i]->month}}</div>
                                        <div class="h7">Data wytworzenia: {{$taxSettlements[$i]->date}}</div>
                                        <div class="h7">Podatek należny: {{$taxSettlements[$i]->vat}} zł</div>
                                    </div>
                                    <div class="flex-column text-right">
                                        <div class="mt-3 ">
                                            <a href="{{ url('/taxSettlements/'.$taxSettlements[$i]->id) }}" class="btn btn-dark" role="button" aria-pressed="true">Podgląd</a>
                                            <a href="{{ url('/taxSettlements/'.$taxSettlements[$i]->id.'/edit') }}" class="btn btn-dark" role="button" aria-pressed="true">Generuj XML</a>
                                            <a href="{{ url('/taxSettlements/'.$taxSettlements[$i]->id.'/delete') }}" class="btn btn-dark" role="button" aria-pressed="true">Usuń</a>
                                        </div>
                                        <div>
{{--                                            <div class="h5 mt-3">Kwota brutto: {{$price[$i]}}</div>--}}

                                        </div>

                                    </div>
                                </div>

                            @endfor


                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
