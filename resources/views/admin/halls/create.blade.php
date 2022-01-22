@extends('layouts.template')
@section('main')
    <h1>Zaal Aanmaken</h1>
    <form action="/admin/halls" method="post">
        @method('post')
        @csrf
        <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Naam" minlength="2" maxlength="255"
                required>

            <label for="capacity">Capaciteit</label>
            <input type="number" name="capacity" id="capacity" class="form-control" placeholder="Capaciteit" min="0"
                required>

            <label for="address">Adres</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Adres" minlength="2"
                maxlength="255" required>

            <label for="place">Plaats</label>
            <input type="text" name="place" id="place" class="form-control" placeholder="Plaats" minlength="2"
                maxlength="255" required>

            <label for="postalCode">Postcode</label>
            <input type="text" name="postalCode" id="postalCode" class="form-control" placeholder="Postcode" minlength="4"
                maxlength="4" required>
        </div>
        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save mr-1"></i> Opslaan</button>
    </form>
@endsection
