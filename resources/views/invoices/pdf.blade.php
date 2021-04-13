<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl-pl" lang="pl-pl" dir="ltr" >
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <title>eFIRMA</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="../../../public/css/app.css" rel="stylesheet" />


</head>
<body>
<style type="text/css">

    body {
        margin-left: -15px;
        margin-right: -15px;
        font-family: DejaVu Sans, serif;
        font-size: 12px;
    }

    .text-left {
        text-align: left ;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .h3, .h5{
        line-height: 1.2;
        font-weight: normal;
    }

    .h2 {
        font-size: 28px;
    }

    .h3 {
        font-size: 24px;
    }

    .h5 {
        font-size: 8px;
        color: #737373;
        font-weight: normal;

    }

    .row {
        display: flex;
        flex-wrap: wrap;
    }

    .my-5 {
        margin-top: 3rem !important;
    }


    .mt-5{
        margin-top: 80px;
    }

    .col-lg-12,  .col-12 {
        position: relative;
        width: 100%;
    }

    .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }


    .col-lg-12 {
        flex: 0 0 100%;
        max-width: 100%;
    }
    .table {
        width: 100%;
        color: #000000;
        border-color: grey;
    }

    .border-top {
        border-top: 1px solid #c6c6c6;
    }

    thead.border-bottom {
        border-bottom: 1px solid #e0e0e0;
    }

    tbody.border-bottom {
        padding-bottom: 10px;
        margin-bottom: 10px;
        border-bottom: 1px solid #e0e0e0;
    }

    .mb-3{
        margin-bottom: 20px;
    }

    tr.spaceUnder-2>td {
        padding-bottom: 2em;
    }

    tr.spaceUnder>td {
        padding-bottom: 0.75em;
    }

    tr.spaceAbove>td {
        padding-top: 0.75em;
    }

</style>
<div class="col-lg-12 " >
    <div class="my-5 row">
        <div class="col-12">

            <table class="table" style="margin-top: 20px">
                <tbody class="text-left "  >
                    <tr class="spaceUnder-2">
                        <td class="h3"><b class="h2">{{ __('Faktura ') }}</b> {{$invoice->invoice_number}}</div></td>
                        <td >
                            <div class="h5">
                                DATA WYSTAWIENIA
                            </div>
                            {{ $invoice->issue_date }}
                        </td>
                        <td >
                            <div class="h5">
                                DATA SPRZEDAŻY
                            </div>
                            {{ $invoice->due_date }}
                        </td>

                    </tr>

                    <tr>
                        <td style="width: 50%">
                            <div class="h5">
                                DANE NABYWCY
                            </div>
                            <b>{{ $invoice->company}}</b><br>
                            {{ $invoice->street_name }} {{ $invoice->house_number }} <br>
                            {{ $invoice->city }} {{ $invoice->postal_code }} <br>
                        NIP: {{ $invoice->nip }}
                        </td>

                        <td colspan="2">
                            <div class="h5">
                                DANE SPRZEDAWCY
                            </div>
                            <b>{{ $user->company}}</b><br>
                            {{ $user->street_name }} {{ $user->house_number }}<br>
                            {{ $user->city }} {{ $user->postal_code }}<br>
                        NIP: {{ $user->nip }}

                        </td>
                    </tr>
                </tbody>
            </table>

            <table class=" mt-5 table mb-3">
                <thead class="border-bottom">
                    <tr class="text-right h5 spaceUnder">
                        <td class="text-left ">NAZWA PRODUKTU/USŁUGI</td>
                        <td>ILOŚĆ</td>
                        <td >CENA JEDNOSTKOWA</td>
                        <td >NETTO</td>
                        <td >VAT 23%</td>
                        <td >BRUTTO</td>
                    </tr>
                </thead>

                <tbody class="text-right border-bottom">
                @for($i=0; $i < $productsNumber; $i++)
                    <tr class="spaceAbove">
                        <td style="width: 42%" class="text-left">{{$product[$i][0]}}</td>
                        <td style="width: 8%">{{$product[$i][1]}}</td>
                        <td style="width: 17%">{{$product[$i][2]}}</td>
                        <td style="width: 11%">{{$product[$i][3]}}</td>
                        <td style="width: 11%">{{$product[$i][4]}}</td>
                        <td style="width: 11%">{{$product[$i][5]}}</td>
                    </tr>
                @endfor
                </tbody>
            </table>
            <table class="table text-right">
                <tbody>
                    <tr class="h5">
                        <td colspan="2">NETTO</td>
                        <td >VAT 23%</td>
                        <td >BRUTTO</td>
                    </tr>
                    <tr class=" text-right">
                        <td style="width: 67%;padding-right: 10px" >SUMA</td>
                        <td style="width: 11%"><b>{{$all_products_price[0]}}</b></td>
                        <td style="width: 11%"><b>{{$all_products_price[1]}}</b></td>
                        <td style="width: 11%"><b>{{$all_products_price[2]}}</b></td>
                    </tr>
                </tbody>
            </table>

        <table class="table text-center" style="bottom: 50px; left: -15px; position: fixed;">
            <tbody>
                <tr>
                    <td class="border-top h5" style="width: 40%">Podpis osoby upoważnionej do odbioru</td>
                    <td style="width: 20%"></td>
                    <td class="border-top h5" style="width: 40%">Podpis osoby upoważnionej do wystawienia</td>
                </tr>

            </tbody>
        </table>


        </div>
    </div>
</div>
</body>
</html>
