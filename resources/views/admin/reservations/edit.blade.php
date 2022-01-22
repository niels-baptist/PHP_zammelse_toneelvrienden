@extends('layouts.template')
@section('main')
    <h1>Reservatie Bewerken</h1>
    <h2>{{ $reservation->surname }} {{ $reservation->firstName }}</h2>

    <form action="/admin/reservations/{{ $reservation->id }}" method="post">
        @method('put')
        @include('admin.reservations.form')
    </form>
@endsection
