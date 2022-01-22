@extends('layouts.template')
@section('main')
    <h1>Zaal Bewerken</h1>
    <h2>{{ $hall->name }}</h2>
    <form action="/admin/halls/{{ $hall->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Name" minlength="2" maxlength="255"
                required value="{{ old('name', $hall->name) }}">

            <label for="capacity">Capaciteit</label>
            <input type="number" name="capacity" id="capacity" class="form-control" placeholder="Capaciteit" min="0"
                required value="{{ old('capacity', $hall->capacity) }}">

            <label for="address">Adres</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Adres" minlength="2"
                maxlength="255" required value="{{ old('address', $hall->address) }}">

            <label for="place">Plaats</label>
            <input type="text" name="place" id="place" class="form-control" placeholder="Plaats" minlength="2"
                maxlength="255" required value="{{ old('place', $hall->place) }}">

            <label for="postalCode">Postcode</label>
            <input type="text" name="postalCode" id="postalCode" class="form-control" placeholder="Postcode" minlength="4"
                maxlength="4" required value="{{ old('postalCode', $hall->postalCode) }}">
        </div>
        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save mr-1"></i> Opslaan</button>
    </form>
@endsection
