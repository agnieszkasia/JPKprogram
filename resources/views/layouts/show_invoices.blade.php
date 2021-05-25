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

    @yield('header')

    <div class="d-flex justify-content-between row mx-5">
        @yield('form')
            @csrf

            <select name="cities" id="cities" class="form-control mx-2">
                <option value="">Miasto</option>

                @foreach($cities as $city)

                    <option value="{{$city}}" @if($selectedCity == $city) selected @endif>{{$city}}</option>

                @endforeach
            </select>


            <input id="start_date" name="start_date" placeholder="Data od" value="@if($startDate) {{  $startDate }}@endif" class="ml-2"/>
            <input id="end_date" name="end_date" placeholder="Data do" value="@if($endDate) {{  $endDate }}@endif" class="ml-4"/>


            <button type="submit" name="filter" class="btn btn-dark ml-4 mr-5">Wyszukaj</button>

            <select name="sort" id="sort" class="custom-select ml-5">
                <option value="">Sortuj</option>

                @foreach($sortingOptions as $option)

                    <option value="{{$option['value']}}" @if($selectedOption == $option['value']) selected @endif>{{$option['name']}}</option>

                @endforeach

            </select>
        </form>
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
            @yield('table')
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
                @yield('foreach')
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/filter.js') }}" type="text/javascript" ></script>

@endsection
