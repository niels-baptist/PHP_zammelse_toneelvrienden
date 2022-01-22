@extends('layouts.template')
@section('main')
    <div class="alert alert-success border-success">
        <div class="row">
            <div class="col-12">
                <h1>Uw reservatie is gelukt!</h1>
            </div>
            <div class="col-sm-12 col-lg-6">
                <span class="font-weight-bold">Uw reservatie werd geregistreerd, hieronder vindt u de details: </span>
                <hr>
                Toneelstuk: {{ $reservation->performance->play->name }} <br>
                Datum: {{ $reservation->performance->dateTime }}<br>
                Locatie:
                {{ $reservation->performance->hall->name . ' ' . $reservation->performance->hall->address . ', ' . $reservation->performance->hall->postalCode . ' ' . $reservation->performance->hall->place }}<br>
                <hr>
                Naam: {{ $reservation->firstName . ' ' . $reservation->surname }}<br>
                Email: {{ $reservation->email }}<br>
                Telefoonnummer: {{ $reservation->telephone }}<br>
                Adres: {{ $reservation->address . ', ' . $reservation->postalCode . ' ' . $reservation->place }}
            </div>
            <hr>
            <div class="col-sm-12 col-lg-6">
                <img class="p-2 w-75 mt-sm-5 mt-lg-0" src="./img/success.svg" alt="Success">
            </div>
        </div>

    </div>
    <?php
    session_start();
    if (isset($_SESSION['a'])) {
    header('Location: /');
    unset($_SESSION['a']);
    session_destroy();
    } else {
    $_SESSION['a'] = 'a';
    }
    ?>
@endsection
