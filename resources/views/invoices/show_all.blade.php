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
    <div class="my-5 h3 text-center ">FAKTURY</div>

    <div class="container-fluid mt-5 mb-lg-5 d-flex justify-content-end position-absolute">
        <a href="{{ route('create_invoice') }}" class="btn btn-dark" role="button" aria-pressed="true">Dodaj fakture</a>
    </div>

    <div class="d-flex justify-content-between row mx-5">
        <form action="{{route('search_invoices')}}" method="post" class="d-flex">
            @csrf

            <select name="cities" id="cities" class="form-control mx-2">
                <option value="">Miasto</option>

                @foreach($cities as $city)

                    <option value="{{$city}}" @if($selectedCity == $city) selected @endif>{{$city}}</option>

                @endforeach
            </select>


            <input id="start_date" name="start_date" placeholder="Data od" value="@if($startDate) {{  $startDate }}@endif" class="ml-2"/>
            <input id="end_date" name="end_date" placeholder="Data do" value="@if($endDate) {{  $endDate }}@endif" class="ml-4"/>


            <button type="submit" name="filter" class="btn btn-dark ml-4">Wyszukaj</button>

            <select name="sort" id="sort" class="custom-select ">
                <option value="">Sortuj</option>

                <option value="asc_issue_date" >Data wystawienia od najnowszych</option>
                <option value="desc_issue_date">Data wystawienia od najstarszych</option>
                <option value="asc_due_date">Data sprzedaży od najnowszych</option>
                <option value="desc_due_date">Data sprzedaży od najstarszych</option>
                <option value="asc_number">Numer faktury od najnowszych</option>
                <option value="desc_number">Numer faktury od najstarszych</option>
                <option value="asc_data">Dane sprzedawcy A-Z</option>
                <option value="desc_data">Dane sprzedawcy Z-A</option>
            </select>


        </form>

        <script>
            $('#start_date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd',
                weekStartDay: 1
            });
            $('#end_date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd',
                weekStartDay: 1
            });
            $('#sort').on('change', function(e){
                $(this).closest('form').submit();
            });
        </script>

{{--        <form action="{{route('sort_invoices')}}" method="post" class="d-flex">--}}


{{--        </form>--}}

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

    <div class="mb-lg-5 mt-lg-3 bg-white">
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


