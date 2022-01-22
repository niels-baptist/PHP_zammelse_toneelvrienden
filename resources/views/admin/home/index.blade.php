@extends('layouts.template')
@section('main')
    <h1 class="text-center">Welkom {{ $user->firstName }}!</h1>
    <hr>
    <div class="row d-flex">
        <div class="col-12 col-md-6 col-lg-4 ">
            <div class="card my-2 mx-lg-2">
                <div class="card-body">
                    <h5 class="card-title">Toneelstukken Beheren</h5>
                    <p class="card-text">
                        Hier kunt u een overzicht zien van alle actieve en inactieve
                        toneelstukken.
                    </p>
                    <a href="/admin/play" class="card-link">Naar toneelstukken</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card my-2 mx-lg-2">
                <div class="card-body">
                    <h5 class="card-title">Reservaties Beheren</h5>
                    <p class="card-text">
                        Hier kunt u een overzicht zien van alle reservaties per voorstelling.
                    </p>
                    <a href="/admin/reservations" class="card-link">Naar reservaties</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card my-2 mx-lg-2">
                <div class="card-body">
                    <h5 class="card-title">Medewerkers Beheren</h5>
                    <p class="card-text">
                        Hier kunt u een overzicht zien van alle geregistreerde medewerkers.
                    </p>
                    <a href="/admin/users" class="card-link">Naar medewerkers</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card my-2 mx-lg-2">
                <div class="card-body">
                    <h5 class="card-title">Voorstellingen Beheren</h5>
                    <p class="card-text">
                        Hier kunt u een overzicht zien van alle voorstellingen.
                    </p>
                    <a href="/admin/performances" class="card-link">Naar voorstellingen</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card my-2 mx-lg-2">
                <div class="card-body">
                    <h5 class="card-title">Zalen Beheren</h5>
                    <p class="card-text">
                        Hier kunt u een overzicht zien van alle geregistreerde zalen.
                    </p>
                    <a href="/admin/halls" class="card-link">Naar zalen</a>
                </div>
            </div>
        </div>
    @endsection
