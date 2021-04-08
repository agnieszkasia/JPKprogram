@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="mt-5 h3 text-center ">{{ __('FAKTURY') }}</div>

                    <div class="container-fluid mt-3 d-flex justify-content-end">
                        <a href="{{ route('create_invoice') }}" class="btn btn-dark" role="button" aria-pressed="true">Dodaj fakture</a>
                    </div>

                <div class="my-lg-5 bg-white">
                    <div class="row mx-5">
                        <table class="table table-borderless table-responsive">
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
                            @for($i=0; $i<count($invoices); $i++)
                                <tr class="border-bottom ">
                                    <td class="flex-column">
                                        <div>{{$invoices[$i]->company}}</div>
                                        <div>{{$invoices[$i]->street_name}} {{$invoices[$i]->house_number}}</div>
                                        <div>{{$invoices[$i]->postal_code}} {{$invoices[$i]->city}}</div>
                                        <div>NIP: {{$invoices[$i]->nip}}</div>
                                    </td>
                                    <td class="">{{$invoices[$i]->invoice_number}}</td>
                                    <td>{{$invoices[$i]->issue_date}}</td>
                                    <td>{{$invoices[$i]->due_date}}</td>

                                    <td>{{$invoices[$i]->vat}}</td>
                                    <td>{{$invoices[$i]->netto}}</td>
                                    <td>{{$invoices[$i]->brutto}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{ url('/invoice/'.$invoices[$i]->id) }}">Podgląd</a>
                                                <a class="dropdown-item" href="{{ url('/invoice/'.$invoices[$i]->id.'/edit') }}">Edytuj</a>
                                                <a class="dropdown-item" href="{{ url('/invoice/'.$invoices[$i]->id.'/delete') }}">Usuń</a>
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
        </div>
</div>
@endsection
