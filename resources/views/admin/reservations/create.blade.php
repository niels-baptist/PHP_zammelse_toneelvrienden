@extends('layouts.template')
@section('main')
    <div class="row">
        <h1 class="col-10">Nieuwe Reservatie: {{ $reservation->firstName }}</h1>
    </div>

    <form action="/admin/reservations/{{ $reservation->id }}" method="post">
        @include('admin.reservations.form')
    </form>
@endsection
