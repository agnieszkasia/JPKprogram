@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">

                <div class="mt-5 h3 text-center ">{{ __('ROZLICZENIA') }}</div>
                    <div class="container-fluid mt-3 d-flex justify-content-end">
                        <a href="{{ route('create_tax_settlement') }}" class="btn btn-dark" role="button" aria-pressed="true">Generuj rozliczenie</a>
                    </div>
                    <div class="container-fluid mt-3 d-flex justify-content-end">
                        <a href="{{ route('create_tax_correction') }}" class="btn btn-dark" role="button" aria-pressed="true">Utwórz korekte</a>
                    </div>

                <div class="card-body">
                    <div class="container-xl">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif



                    </div>
                </div>
            </div>
        </div>
</div>
@endsection
