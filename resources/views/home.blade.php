@extends('layouts.app')

@section('content')
    <div class="mt-5 h3 text-center ">STRONA GŁÓWNA</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
</div>
<div class="d-flex">
    <div class="col-lg-6 pl-0">
        <div class="card mt-4 ">
            <div class="mt-5 h3 text-center ">FAKTURY SPRZEDAŻY</div>

            <div class="container-fluid mt-3 mb-lg-5 d-flex justify-content-end">
                <a href="{{ route('create_invoice') }}" class="btn btn-dark" role="button" aria-pressed="true">Dodaj fakture</a>
            </div>

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
        </div>
    </div>
    <div class="col-lg-6 pr-0 mb-4" >
        <div class="card mt-4 h-100">
            <div class="h-100">
            <div class="mt-5 h3 text-center ">FAKTURY ZAKUPU</div>

            <div class="container-fluid mt-3 d-flex justify-content-end">
                <a href="{{ route('create_purchase_invoice') }}" class="btn btn-dark" role="button" aria-pressed="true">Dodaj fakture</a>
            </div>

            <div class="my-lg-5 bg-white">
                <div class="row mx-5">
                    <table id="purchaseInvoicesTable" class="table table-borderless table-responsive">
                        <thead>
                        <tr class="border-bottom h6">
                            <th style="width: 30%" >Dane sprzedawcy</th>
                            <th style="width: 20%">Numer faktury</th>
                            <th style="width: 4%"></th>
                        </tr>
                        </thead>

                        <tbody class="">
                        @foreach($purchaseInvoices as $purchaseInvoice)
                            <tr class="border-bottom ">
                                <td style="display:none;">{{$purchaseInvoice->id}}</td>

                                <td class="flex-column">
                                    <div>{{$purchaseInvoice->company}}</div>
                                    <div>{{$purchaseInvoice->street_name}} {{$purchaseInvoice->house_number}}</div>
                                    <div>{{$purchaseInvoice->postal_code}} {{$purchaseInvoice->city}}</div>
                                    <div>NIP: {{$purchaseInvoice->nip}}</div>
                                </td>
                                <td class="">{{$purchaseInvoice->invoice_number}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{ url('/purchaseinvoice/'.$purchaseInvoice->id) }}">Podgląd</a>
                                            <a class="dropdown-item" href="{{ url('/purchaseinvoice/'.$purchaseInvoice->id.'/edit') }}">Edytuj</a>
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
            </div>
        </div>
    </div>
</div>
    <div class="card mt-4">
        <div class="mt-5 h3 text-center ">ROZLICZENIA</div>
        <div class="d-flex container-fluid justify-content-end">
            <div class="mt-3 d-flex mr-3">
                <a href="{{ route('create_tax_settlement') }}" class="btn btn-dark" role="button" aria-pressed="true">Utwórz rozliczenie</a>
            </div>
        </div>

        <div class="my-lg-5 bg-white">
            <div class="row mx-5">
                <table id="settlementTable" class="table table-borderless table-responsive">
                    <thead>
                    <tr class="border-bottom h6">
                        <th style="width: 42%" >Okres rozliczeniowy</th>
                        <th style="width: 12%" >Podatek należny</th>
                        <th style="width: 12%" >Wartość sprzedaży</th>
                        <th style="width: 12%" >Wartość zakupu</th>
                        <th style="width: 18%">Data wytworzenia</th>
                        <th style="width: 4%"></th>
                    </tr>
                    </thead>

                    <tbody class="">
                    @for($i=0; $i<count($taxSettlements); $i++)
                        <tr class="border-bottom ">
                            <td style="display:none;">{{$taxSettlements[$i]->id}}</td>

                            <td>{{$taxSettlements[$i]->year}}-{{$taxSettlements[$i]->month}}</td>
                            <td >{{$taxSettlements[$i]->vat}} zł</td>
                            <td >{{$taxSettlements[$i]->sale_brutto}} zł</td>
                            <td >{{$taxSettlements[$i]->purchase_brutto}} zł</td>
                            <td>{{$taxSettlements[$i]->date}}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ url('/settlement/'.$taxSettlements[$i]->id) }}">Podgląd</a>
                                        <a class="dropdown-item" href="{{ url('/settlement/'.$taxSettlements[$i]->id.'/generateXML') }}">Generuj XML</a>
                                        <a class="dropdown-item deletebtn" href="javascript:void(0)">Usuń</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
