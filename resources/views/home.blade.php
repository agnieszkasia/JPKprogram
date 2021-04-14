@extends('layouts.app')

@section('content')
    <div class="mt-5 h3 text-center ">STRONA GŁÓWNA</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                </div>
@endsection
