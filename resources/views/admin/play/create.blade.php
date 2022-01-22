@extends('layouts.template')
@section('main')
    <h1>Toneelstuk Aanmaken</h1>
    <form action="/admin/play" method="post">
        @include('admin.play.playForm')
    </form>
@endsection
