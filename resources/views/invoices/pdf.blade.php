<!doctype html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <META HTTP-EQUIV="Content-Language" CONTENT="pl-PL">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>eFIRMA</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">


</head>
<body>
<style type="text/css">

    body {
        font-family: DejaVu Sans;
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

    .h3, .h5, .h6 {
        margin-bottom: 0.5rem;
        font-weight: 500;
        line-height: 1.2;
    }

    .h3 {
        font-size: 1.575rem;
    }

    .h5 {
        font-size: 1.125rem;
    }

    .h6 {
        font-size: 0.9rem;
    }


    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .my-5 {
        margin-top: 3rem !important;
    }

    .my-5 {
        margin-bottom: 3rem !important;
    }

    .mt-2{
        margin-top: 40px;
    }

    .mt-5{
        margin-top: 100px;
    }

    .col-lg-12, .col-md-2,  .col-12 {
        position: relative;
        width: 100%;
    }

    .col-md-2 {
        flex: 0 0 12%;
        max-width: 12%;
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
        color: #212529;
        border-collapse: collapse !important;
    }

    .border-bottom {
        border-bottom: 1px solid #4a4a4a
    }

</style>
    <div class="col-lg-12 " style="font-family: 'Agency FB',monospace">
        <div class="mt-2 h3 text-center ">{{ __('Faktura nr: ') }} {{$invoice->invoice_number}}</div>
        <div class="my-5 row">
            <div class="col-12">

                <table class="table mt-2" >
                    <tbody class="text-left " style="vertical-align: baseline">
                        <tr>
                            <td>
                                <div class="h5">
                                    Dane nabywcy:
                                </div>
                                {{ $invoice->company}}<br>
                                {{ $invoice->street_name }} {{ $invoice->house_number }} <br>
                                {{ $invoice->city }} {{ $invoice->postal_code }} <br>
                                NIP: {{ $invoice->nip }}
                            </td>

                            <td >
                                <div class="h5">
                                    Dane sprzedawcy:
                                </div>
                                {{ $user->company}}<br>
                                {{ $user->street_name }} {{ $user->house_number }}<br>
                                {{ $user->city }} {{ $user->postal_code }}<br>
                                NIP: {{ $user->nip }}
                            </td>

                            <td>
                                <div class="h5">
                                    Data wystawienia:
                                </div>
                                {{ $invoice->issue_date }}<br><br>
                                <div class="h5">
                                    Data sprzedaży:
                                </div>
                                    {{ $invoice->due_date }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class=" mt-5 table">
                    <thead class="border-bottom">
                        <tr class="text-right">
                            <td class="col-md-2 h5 text-left ">Nazwa produktu/usługi</td>
                            <td class="col-md-2 h6">Ilość</td>
                            <td class="col-md-2 h6" >Cena jednostkowa</td>
                            <td class="col-md-2 h6" >Netto</td>
                            <td class="col-md-2 h6" >VAT</td>
                            <td class="col-md-2 h6" >Brutto</td>
                        </tr>
                    </thead>

                    <tbody class="text-right border-bottom">
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

                    <tr class="h5" style="outline: thin solid">
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
</body>
</html>
