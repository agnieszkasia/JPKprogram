@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">

                <div class="mt-5 h3 text-center ">{{ __('FAKTURY ZAKUPU') }}</div>
                    <div class="container-fluid mt-3 d-flex justify-content-end">
                        <a href="{{ route('create_purchase_invoice') }}" class="btn btn-dark" role="button" aria-pressed="true">Dodaj fakture</a>
                    </div>

                <div class="card-body">
                    <div class="container-xl">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @for($i=0; $i<count($purchaseInvoices); $i++)
                            <div class="mb-3 d-flex justify-content-between border-top">
                                <div class="flex-column mt-3">
                                    <div class="h5">{{$purchaseInvoices[$i]->company}}</div>
                                    <div class="h5">{{$purchaseInvoices[$i]->street_name}} {{$purchaseInvoices[$i]->house_number}}</div>
                                    <div class="h5">{{$purchaseInvoices[$i]->postal_code}} {{$purchaseInvoices[$i]->city}}</div>
                                    <div class="h5">NIP: {{$purchaseInvoices[$i]->nip}}</div>
                                </div>
                                <div class="flex-column text-right">
                                    <div class="mt-3 ">
                                        <a href="{{ url('/purchaseinvoices/'.$purchaseInvoices[$i]->id) }}" class="btn btn-dark" role="button" aria-pressed="true">Podgląd</a>
                                        <a href="{{ url('/purchaseinvoices/'.$purchaseInvoices[$i]->id.'/edit') }}" class="btn btn-dark" role="button" aria-pressed="true">Edytuj</a>
                                        <a href="{{ url('/purchaseinvoices/'.$purchaseInvoices[$i]->id.'/delete') }}" class="btn btn-dark" role="button" aria-pressed="true">Usuń</a>
                                    </div>
                                    <div>
{{--                                        <div class="h5 mt-3">Kwota brutto: {{$price[$i]}}</div>--}}

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
