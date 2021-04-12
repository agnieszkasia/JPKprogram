@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10 center">
            <div class="card bg-text" style="margin-top: 5%">
                <div class="mt-5 mb-3 h3 text-center ">Profil</div>
                <div class="card-body mb-5 mr-3">

                    {{--Imię, nazwisko--}}
                    <div class="row">
                        <div class="col-sm-2 text-md-right">Imię</div>
                        <div class="col-sm-4 "><b>{{ $user->first_name }} </b></div>

                        <div class="col-sm-2 text-md-right">Nazwisko</div>
                        <div class="col-sm-4 "><b>{{ $user->family_name }} </b></div>
                    </div>

                    {{--Nazwa firmy--}}
                    <div class="row mt-sm-4">
                        <div class="col-sm-2 text-md-right">Nazwa firmy</div>
                        <div class="col-sm-10"><b>{{ $user->company }}</b> </div>
                    </div>

                    <div class="row mt-lg-4">
                        {{--Ulica--}}
                        <div class="col-sm-2 text-md-right">Ulica</div>
                        <div class="col-sm-4"><b>{{ $user->street_name }} </b></div>
                        {{--numer budynku--}}
                        <div class="col-sm-2 text-md-right">Nr budynku</div>
                        <div class="col-sm-4"><b>{{ $user->house_number }}</b></div>
                    </div>

                    <div class="row mt-lg-4">
                        {{--Kod pocztowy--}}
                        <div class="col-sm-2 text-md-right">Kod pocztowy</div>
                        <div class="col-sm-4"><b>{{ $user->postal_code }} </b></div>
                        {{--Miasto--}}
                        <div class="col-sm-2 text-md-right">Miasto</div>
                        <div class="col-sm-4"><b>{{ $user->city }}</b></div>
                    </div>

                    <div class="row mt-lg-4">
                        {{--Data urodzenia--}}
                        <div class="col-sm-2 text-md-right">Data urodzenia</div>
                        <div class="col-sm-4"><b>{{ $user->birth_date }} </b></div>
                        {{--NIP--}}
                        <div class="col-sm-2 text-md-right">{{ __('NIP') }}</div>
                        <div class="col-sm-4"><b>{{ $user->nip }}</b></div>
                    </div>

                    {{--Email--}}
                    <div class="row mt-sm-4">
                        <div class="col-sm-2 text-md-right">Adres E-mail</div>
                        <div class="col-sm-10"><b>{{ $user->email }}</b> </div>
                    </div>

                    <div class="form-group row mb-0 justify-content-end">
                        <div class=" mr-4">
                            <a href="{{ url('/profile/'.$user->id.'/editpassword') }}" class="btn btn-dark" role="button" aria-pressed="true">Zmień hasło</a>
                        </div>

                        <div class=" mr-4">
                            <a href="{{ url('/profile/'.$user->id.'/edit') }}" class="btn btn-dark" role="button" aria-pressed="true">Edytuj</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-text" style="margin-top: 5%">
                <div class="mt-5 mb-3 h3 text-center ">Informacje dodatkowe o firmie</div>

                <div class="card-body mb-5 mr-3">
                    @if($user->companyTaxInformation == null)
                        <div class="form-group row mb-0 justify-content-end">
                            <div class=" mr-4">
                                <a href="{{ url('/companyinformation/add') }}" class="btn btn-dark" role="button" aria-pressed="true">Dodaj informacje</a>
                            </div>
                        </div>
                    @else

                    {{--Rozliczenie miesięczne/kwartalne--}}
                    <div class="row mt-sm-4">
                        <div class="col-sm-2 text-md-right">Tryb rozliczenia</div>
                        <div class="col-sm-10"><b>{{ $companyTaxInformation->settlement_form }}</b> </div>
                    </div>

                    {{--Podmiot--}}
                    <div class="row mt-sm-4">
                        <div class="col-sm-2 text-md-right">Podmiot</div>
                        <div class="col-sm-10"><b>{{ $companyTaxInformation->entity_type }}</b> </div>
                    </div>

                    {{--Kod urzędu--}}
                    <div class="row mt-sm-4">
                        <div class="col-sm-2 text-md-right">Kod urzędu</div>
                        <div class="col-sm-10"><b>{{ $companyTaxInformation->office_code }}</b> </div>
                    </div>

                    <div class="form-group row mb-0 justify-content-end">
                        <div class=" mr-4">
                            <a href="{{  url('/companyinformation/'.$companyTaxInformation->id.'/edit') }}" class="btn btn-dark" role="button" aria-pressed="true">Edytuj</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
