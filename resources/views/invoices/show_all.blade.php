@extends('layouts.app')

@section('main_content')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="delete_modal_form" method="post" >
                    @csrf

                    <div class="modal-body text-center h5">
                        <input type="hidden" id="delete_invoice_id">
                        Czy na pewno chcesz usunąc fakturę ?

                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')


    <div class="mt-5 h3 text-center ">FAKTURY</div>

    <div class="container-fluid mt-3 mb-lg-5 d-flex justify-content-end">
        <a href="{{ route('create_invoice') }}" class="btn btn-dark" role="button" aria-pressed="true">Dodaj fakture</a>
    </div>

    <form action="" method="post" class="d-flex">
        <input name="start_date" type="date" class="form-control col-2" placeholder="data od">
        <input name="end_date" type="date" class="form-control col-2" >
    </form>

    @if(session()->has('message'))
        <div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between" role="alert">
            <div class="mt-2">
                <strong>UWAGA!</strong> Zmiany został zapisane. Faktura znajduje się w rozliczeniu miesięcznym. Rozliczenie zostało zaktualizowane automatycznie.
            </div>
            <div>
                <a href="{{ url('/settlement/'.session()->get('message')) }}" class="btn btn btn-warning" role="button" aria-pressed="true">Przejdz do rozliczenia</a>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <div class="mb-lg-5 bg-white">
        <div class="row mx-5">
            <table id="invoicesTable" class="table table-borderless table-responsive">
                <thead>
                <tr class="border-bottom h6">
                    <th style="width: 30%" >Dane sprzedawcy</th>
                    <th style="width: 20%">Numer faktury</th>
                    <th style="width: 14%">Data wystawienia</th>
                    <th style="width: 14%">Data sprzedaży</th>
                    <th style="width: 6%">VAT</th>
                    <th style="width: 6%">Netto</th>
                    <th style="width: 6%">Brutto</th>
                    <th style="width: 4%"></th>
                </tr>
                </thead>

                <tbody class="">
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
                                    <a class="dropdown-item" href="{{ url('/invoice/'.$invoice->id) }}">Podgląd</a>
                                    <a class="dropdown-item" href="{{url('/invoice/'.$invoice->id.'/pdf') }}">Generuj PDF</a>
                                    <a class="dropdown-item" href="{{ url('/invoice/'.$invoice->id.'/edit') }}">Edytuj</a>
                                    <a class="dropdown-item deletebtn" href="javascript:void(0)">Usuń</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
