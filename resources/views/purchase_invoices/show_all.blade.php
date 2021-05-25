@extends('layouts.show_invoices')

@section('header')
    <div class="my-5 h3 text-center ">FAKTURY ZAKUPU</div>

    <div class="container-fluid mt-5 mb-lg-5 d-flex justify-content-end position-absolute">
        <a href="{{ route('create_purchase_invoice') }}" class="btn btn-dark" role="button" aria-pressed="true">Dodaj fakture</a>
    </div>
@endsection

@section('form')
    <form action="{{route('search_purchase_invoices')}}" method="post" class="d-flex">
@endsection

@section('table')
    <table id="purchaseInvoicesTable" class="table table-borderless table-responsive">
@endsection

@section('foreach')
    @foreach($invoices as $invoice)
                <tr class="border-bottom ">
                    <td style="display:none;">{{$invoice->id}}</td>

                    <td class="flex-column">
                        <div>{{$invoice->company}}</div>
                        <div>{{$invoice->street_name}} {{$invoice->house_number}}</div>
                        <div>{{$invoice->postal_code}} {{$invoice->city}}</div>
                        <div>NIP: {{$invoice->nip}}</div>
                    </td>
                    <td class="">{{$invoice->invoice_number}}</td>
                    <td>{{$invoice->issue_date}}</td>
                    <td>{{$invoice->due_date}}</td>

                    <td>{{$invoice->vat}}</td>
                    <td>{{$invoice->netto}}</td>
                    <td>{{$invoice->brutto}}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ url('/purchaseinvoice/'.$invoice->id) }}">Podgląd</a>
                                <a class="dropdown-item" href="{{ url('/purchaseinvoice/'.$invoice->id.'/edit') }}">Edytuj</a>
                                <a class="dropdown-item deletebtn" href="javascript:void(0)">Usuń</a>
                            </div>

                        </div>
                    </td>
                </tr>
    @endforeach
@endsection
