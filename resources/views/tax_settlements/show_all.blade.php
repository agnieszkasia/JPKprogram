@extends('layouts.app')

@section('main_content')
    <!-- Delete Modal -->
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
                        Czy na pewno chcesz usunąc rozliczenie ?

                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- End Delete Modal -->

@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-3">

                <div class="mt-5 h3 text-center ">{{ __('ROZLICZENIA') }}</div>
                <div class="d-flex container-fluid justify-content-end">
                    <div class="mt-3 d-flex mr-3">
                        <a href="{{ route('create_tax_settlement') }}" class="btn btn-dark" role="button" aria-pressed="true">Utwórz rozliczenie</a>
                    </div>

                    @if($taxSettlements != null)
                        <div class="mt-3 d-flex ">
                            <a href="{{ route('create_tax_correction') }}" class="btn btn-dark" role="button" aria-pressed="true">Utwórz korekte</a>
                        </div>
                    @endif

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
        </div>
</div>

@endsection
