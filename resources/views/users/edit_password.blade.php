@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10 center">
            <div class="card bg-text" style="margin-top: 10%; margin-bottom: 10%">
                <div class="mt-5 mb-3 h3 text-center ">{{ __('Zmień hasło') }}</div>
{{--                <div>--}}
{{--                    @if(session('errorMsg'))--}}
{{--                        <div class="alert alert-danger alert-dismissible fade in invalid-feedback" role="alert">--}}
{{--                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                <span aria-hidden="true">&times;</span>--}}
{{--                            </button>--}}
{{--                            <strong>Hasło jest prawidłowe</strong>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}

                <div class="card-body mb-5 mr-3 justify-content-center">
                    <form method="POST" action="{{ url('/profile/'.$user->id.'/updatepassword')}}">
                        @csrf

                        {{--Obecne hasło --}}
                        <div class="row">
                            <div class="col-sm-5 text-md-right">
                                <label for="old_password" class="col-form-label">{{ __('Obecne hasło') }}</label>
                            </div>

                            <div class="col-sm-4">
                                <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror @if(session('errorMsg')) is-invalid @endif "  name="old_password" autofocus>

                                @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                @if(session('errorMsg'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Hasło jest nieprawidłowe</strong>
                                </span>
                                @endif
                            </div>

                        </div>

                        {{-- Nowe hasło --}}
                        <div class="row mt-3">
                            <div class="col-sm-5 text-md-right">
                                <label for="new_password" class="col-form-label">{{ __('Nowe hasło') }}</label>
                            </div>
                            <div class="col-sm-4">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" >

                                @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        {{--Potwierdz nowe hasło--}}
                        <div class="row mt-3">
                            <div class="col-sm-5 text-md-right">
                                <label for="confirm_password" class="col-form-label">{{ __('Potiwerdz nowe hasło') }}</label>
                            </div>
                            <div class="col-sm-4">
                                <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password">

                                @error('confirm_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group row mb-0 justify-content-end">
                            <div class=" mr-4 mt-3">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Zapisz') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
