@extends('layouts.template')
@section('main')
    <div class="container">
        <h1 class="page-title">Ons huidig toneelstuk</h1>
        @foreach ($plays as $play)
            <div class="card flex-row flex-wrap flex-md-nowrap my-4 p-4">
                <div class="card-block align-items-center py-2 py-md-0 px-2">
                    <div class="mb-2">
                        <h4 class="card-title font-weight-bold">{{ $play->name }}</h4>
                        <h6 class="card-subtitle">{{ $play->playtime }} Minuten</h6>
                    </div>
                    <p class="card-text">{{ $play->description }}</p>
                    <a href="/reservations" class="btn btn-primary my-2">Tickets boeken</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
