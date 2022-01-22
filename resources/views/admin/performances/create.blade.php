@extends('layouts.template')
@section('title', 'Voorstelling aanmaken')
@section('main')
    <h1>Voorstelling Aanmaken</h1>
    <form action="/admin/performances" method="post">
        @include('admin.performances.form')
    </form>
@endsection
