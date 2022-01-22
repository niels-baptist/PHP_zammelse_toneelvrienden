@extends('layouts.template')
@section('title', 'Voorstelling aanpassen')
@section('main')
    <h1>Voorstelling Bewerken</h1>
    <form action="/admin/performances/{{ $performance->id }}" method="post">
        @method('put')
        @include('admin.performances.form')
    </form>
@endsection
