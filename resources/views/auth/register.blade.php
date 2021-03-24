@extends('layouts.welcome')

@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 center">
                    <div class="card bg-text" style="margin-top: 10%; margin-bottom: 10%">
                        <div class="mt-5 mb-3 h3 text-center ">{{ __('Rejestracja') }}</div>

                        <div class="card-body mb-5 mr-3">
                            <form method="POST"  action="{{ route('register') }}">
                                @csrf

                                {{--Imię, nazwisko--}}
                                <div class="row">
                                    <div class="col-sm-2 text-md-right">
                                        <label for="first_name" class="col-form-label">{{ __('Imię') }}</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="Imię" autocomplete="first_name" autofocus>

                                        @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-2 text-md-right">
                                        <label for="family_name" class="col-form-label">{{ __('Nazwisko') }}</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="family_name" type="text" class="form-control @error('family_name') is-invalid @enderror" name="family_name" value="{{ old('family_name') }}" placeholder="Nazwisko" required autocomplete="family_name" >

                                        @error('family_name')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Nazwa firmy--}}
                                <div class="row mt-sm-4">
                                    <div class="col-sm-2 text-md-right">
                                        <label for="company" class="col-form-label">{{ __('Nazwa firmy') }}</label>

                                    </div>
                                    <div class="col-sm-10">
                                        <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" value="{{ old('company') }}" placeholder="Nazwa firmy" required autocomplete="company" >

                                        @error('company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-lg-4">
                                    {{--Ulica--}}
                                    <div class="col-sm-2 text-md-right">
                                        <label for="street_name" class="col-form-label">{{ __('Ulica') }}</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="street_name" type="text" class="form-control @error('street_name') is-invalid @enderror" name="street_name" value="{{ old('street_name') }}" placeholder="Ulica" required autocomplete="address_line1" >

                                        @error('street_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    {{--numer budynku--}}
                                    <div class="col-sm-2 text-md-right">
                                        <label for="house_number" class="col-form-label text-sm-right">{{ __('Nr budynku') }}</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="house_number" type="text" class="form-control @error('house_number') is-invalid @enderror" name="house_number" value="{{ old('house_number') }}" placeholder="Numer budynku" required autocomplete="address_line2" >

                                        @error('house_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-lg-4">
                                    {{--Kod pocztowy--}}
                                    <div class="col-sm-2 text-md-right">
                                        <label for="postal_code" class="col-form-label">{{ __('Kod pocztowy') }}</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="postal_code" type="text" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" value="{{ old('postal_code') }}" placeholder="00-000" required autocomplete="postal_code" >

                                        @error('postal_code')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{--Miasto--}}
                                    <div class="col-sm-2 text-md-right">
                                        <label for="city" class="col-form-label">{{ __('Miasto') }}</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" placeholder="Miasto" required autocomplete="address-level2" >

                                        @error('city')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-lg-4">
                                    {{--Data urodzenia--}}
                                    <div class="col-sm-2 text-sm-right">
                                        <label for="birth_date" class="col-form-label">{{ __('Data urodzenia') }}</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" value="{{ old('birth_date') }}" required autocomplete="birth_date" >

                                        @error('birth_date')
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    {{--NIP--}}
                                    <div class="col-sm-2 text-sm-right">
                                        <label for="nip" class=" col-form-label">{{ __('NIP') }}</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" placeholder="000 00 00 00" required autocomplete="nip" >

                                        @error('nip')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Email--}}
                                <div class="row mt-lg-4">
                                    <div class="col-md-2 text-md-right">
                                        <label for="email" class="col-form-label text-md-right">{{ __('Adres E-mail') }}</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="email@mail.com" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Hasło--}}
                                <div class="row mt-lg-4">
                                    <div class="col-md-2 text-md-right">
                                        <label for="password" class="col-form-label text-md-right">{{ __('Hasło') }}</label>

                                    </div>
                                    <div class="col-md-10">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{--Potwierdzenie hasła--}}
                                <div class="row mt-lg-4">
                                    <div class="col-md-2 text-md-right">
                                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Potwierdzenie hasła') }}</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input id="password-confirm" type="password" class="form-control @error('password-confirm') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                                        @error('password-confirm')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row mb-0 justify-content-end">
                                    <div class=" mr-4">
                                        <button type="submit" class="btn btn-dark">
                                            {{ __('Zarejestruj') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
