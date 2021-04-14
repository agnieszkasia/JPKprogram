@extends('layouts.app')

@section('content')
    <div class="mt-5 h3 text-center ">MAGAZYN</div>

    <div class="container-fluid mt-3 d-flex justify-content-end">
        <a href="{{ route('create_product') }}" class="btn btn-dark" role="button" aria-pressed="true">Dodaj produkt</a>
    </div>


    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @foreach($magazine as $item)
            <div class="mb-3 d-flex justify-content-between">
                <a href="{{ url('/product/'.$item->id) }}" aria-pressed="true">{{$item->name}}</a>


                <div>
                    <a href="{{ url('/product/'.$item->id.'/edit') }}" class="btn btn-dark" role="button" aria-pressed="true">Edytuj</a>
                    <a href="{{ url('/product/'.$item->id.'/delete') }}" class="btn btn-dark" role="button" aria-pressed="true">Usuń</a>

                </div>
            </div>

        @endforeach

    </div>
@endsection
