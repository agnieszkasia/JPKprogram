<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eFIRMA</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">


</head>
<body>
<style type="text/css">
    .justify-content-center {
        justify-content: center !important;
    }

    .text-left {
        text-align: left !important;
    }

    .text-right {
        text-align: right !important;
    }

    .text-center {
        text-align: center !important;
    }


    h1, h2, h3, h4, h5, h6,
    .h1, .h2, .h3, .h4, .h5, .h6 {
        margin-bottom: 0.5rem;
        font-weight: 500;
        line-height: 1.2;
    }

    h1, .h1 {
        font-size: 2.25rem;
    }

    h2, .h2 {
        font-size: 1.8rem;
    }

    h3, .h3 {
        font-size: 1.575rem;
    }

    h4, .h4 {
        font-size: 1.35rem;
    }

    h5, .h5 {
        font-size: 1.125rem;
    }

    h6, .h6 {
        font-size: 0.9rem;
    }

    .lead {
        font-size: 1.125rem;
        font-weight: 300;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .mt-5,
    .my-5 {
        margin-top: 3rem !important;
    }

    .mr-5,
    .mx-5 {
        margin-right: 3rem !important;
    }

    .mb-5,
    .my-5 {
        margin-bottom: 3rem !important;
    }

    .ml-5,
    .mx-5 {
        margin-left: 3rem !important;
    }


    .col-xl,
    .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg,
    .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md,
    .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm,
    .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col,
    .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1 {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }


    .col-md-1 {
        flex: 0 0 8.3333333333%;
        max-width: 8.3333333333%;
    }

    .col-md-2 {
        flex: 0 0 16.6666666667%;
        max-width: 16.6666666667%;
    }

    .col-md-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }

    .col-md-4 {
        flex: 0 0 33.3333333333%;
        max-width: 33.3333333333%;
    }

    .col-md-5 {
        flex: 0 0 41.6666666667%;
        max-width: 41.6666666667%;
    }

    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .col-md-7 {
        flex: 0 0 58.3333333333%;
        max-width: 58.3333333333%;
    }

    .col-md-8 {
        flex: 0 0 66.6666666667%;
        max-width: 66.6666666667%;
    }

    .col-md-9 {
        flex: 0 0 75%;
        max-width: 75%;
    }

    .col-md-10 {
        flex: 0 0 83.3333333333%;
        max-width: 83.3333333333%;
    }

    .col-md-11 {
        flex: 0 0 91.6666666667%;
        max-width: 91.6666666667%;
    }

    .col-md-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .col-1 {
        flex: 0 0 8.3333333333%;
        max-width: 8.3333333333%;
    }

    .col-2 {
        flex: 0 0 16.6666666667%;
        max-width: 16.6666666667%;
    }

    .col-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }

    .col-4 {
        flex: 0 0 33.3333333333%;
        max-width: 33.3333333333%;
    }

    .col-5 {
        flex: 0 0 41.6666666667%;
        max-width: 41.6666666667%;
    }

    .col-6 {
        flex: 0 0 50%;
        max-width: 50%;
    }

    .col-7 {
        flex: 0 0 58.3333333333%;
        max-width: 58.3333333333%;
    }

    .col-8 {
        flex: 0 0 66.6666666667%;
        max-width: 66.6666666667%;
    }

    .col-9 {
        flex: 0 0 75%;
        max-width: 75%;
    }

    .col-10 {
        flex: 0 0 83.3333333333%;
        max-width: 83.3333333333%;
    }

    .col-11 {
        flex: 0 0 91.6666666667%;
        max-width: 91.6666666667%;
    }

    .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .col-lg-3 {
        flex: 0 0 25%;
        max-width: 25%;
    }

    .col-lg-4 {
        flex: 0 0 33.3333333333%;
        max-width: 33.3333333333%;
    }


    .col-lg-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .mt-lg-2 {
        margin-top: 0.5rem !important;
    }

    .mt-2{
        margin-top: 0.5rem !important;
    }
    .mt-lg-5 {
        margin-top: 3rem !important;
    }


    /*.table {*/
    /*    width: 100%;*/
    /*    margin-bottom: 1rem;*/
    /*    color: #212529;*/
    /*    border-collapse: collapse !important;*/
    /*}*/

    /*.table-responsive {*/
    /*    display: block;*/
    /*    width: 100%;*/
    /*    overflow-x: auto;*/
    /*}*/

    /*.border-bottom {*/
    /*    border-bottom: 1px solid #dee2e6 !important;*/
    /*}*/


    /*.table {*/
    /*    border-collapse: collapse !important;*/
    /*}*/
    /*.table td,*/
    /*.table th {*/
    /*    background-color: #fff !important;*/
    /*}*/

    /*.table-bordered th,*/
    /*.table-bordered td {*/
    /*    border: 1px solid #dee2e6 !important;*/
    /*}*/

    /*.table-dark {*/
    /*    color: inherit;*/
    /*}*/
    /*.table-dark th,*/
    /*.table-dark td,*/
    /*.table-dark thead th,*/
    /*.table-dark tbody + tbody {*/
    /*    border-color: #dee2e6;*/
    /*}*/

    /*.table .thead-dark th {*/
    /*    color: inherit;*/
    /*    border-color: #dee2e6;*/
    /*}*/

</style>
    <div class="justify-content-center">
        <div class="col-lg-12">
            <div class="mt-5 h3 text-center ">{{ __('Faktura nr: ') }} {{$invoice->invoice_number}}</div>
            <div class="my-5">
                <div class="row mx-5">
                    <div class="col-4">
                        <div class="h5">Dane nabywcy:</div>
                        {{--Nazwa firmy--}}
                        <div class="row mt-lg-2">
                            <div class="col-sm-12">{{ $invoice->company}}
                            </div>
                            {{--Ulica--}}
                            <div class="col-sm-8">
                                {{ $invoice->street_name }} {{ $invoice->house_number }}
                            </div>
                            <div class="col-sm-8">
                                {{ $invoice->city }} {{ $invoice->postal_code }}
                            </div>

                            <div class="col-sm-12">
                                NIP: {{ $invoice->nip }}
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="h5">Dane sprzedawcy:</div>
                        {{--Nazwa firmy--}}
                        <div class="row mt-lg-2">
                            <div class="col-lg-12">{{ $user->company}}
                            </div>
                            {{--Ulica--}}
                            <div class="col-lg-8">
                                {{ $user->street_name }} {{ $user->house_number }}
                            </div>
                            <div class="col-lg-8">
                                {{ $user->city }} {{ $user->postal_code }}
                            </div>

                            <div class="col-lg-12">
                                NIP: {{ $user->nip }}
                            </div>
                        </div>
                    </div>

                    <div class="col-3 text-left">

                        {{--Data wystawienia--}}
                        <div class="col-12 h5">
                            {{ __('Data wystawienia:') }}
                        </div>
                        <div class="col-12">
                            {{ $invoice->issue_date }}
                        </div>

                        <div class="col-12 h5 mt-2">
                            {{ __('Data sprzedaży:') }}
                        </div>
                        <div class="col-12">
                            {{ $invoice->due_date }}
                        </div>
                    </div>
                </div>

                <div class="mt-lg-5 col-lg-12">
                    <div class=" row child-repeater-table mx-5">
                        <table class="table table-borderless table-responsive">
                            <thead>
                                <tr class="border-bottom text-right">
                                    <th class="col-1 h5 text-left">Nazwa produktu/usługi</th>
                                    <th class="col-md-2 h6">Ilość</th>
                                    <th class="col-md-2 h6" >Cena jednostkowa</th>
                                    <th class="col-md-2 h6" >Netto</th>
                                    <th class="col-md-2 h6" >VAT</th>
                                    <th class="col-md-2 h6" >Brutto</th>
                                </tr>
                            </thead>

                            <tbody class="text-right">
                                @for($i=0; $i < $productsNumber; $i++)
                                    <tr class="border-bottom">
                                        <td class="text-left">{{$product[$i][0]}}</td>
                                        <td>{{$product[$i][1]}}</td>
                                        <td>{{$product[$i][2]}}</td>
                                        <td>{{$product[$i][3]}}</td>
                                        <td>{{$product[$i][4]}}</td>
                                        <td>{{$product[$i][5]}}</td>
                                    </tr>
                                @endfor

                                <tr class="h5">
                                    <td></td>
                                    <td></td>
                                    <td>Suma</td>
                                    <td>{{$all_products_price[0]}}</td>
                                    <td>{{$all_products_price[1]}}</td>
                                    <td>{{$all_products_price[2]}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
