@extends('layouts.template')
@section('main')
    <h1>Toneelstuk Bewerken</h1>
    <h2>{{ $play->name }}</h2>

    <form action="/admin/play/{{ $play->id }}" method="post">
        @method('put')
        @include('admin.play.playForm')
    </form>
@endsection
