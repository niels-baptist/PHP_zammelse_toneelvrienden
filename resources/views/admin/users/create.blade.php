@extends('layouts.template')
@section('main')
    <h1>Medewerker Toevoegen</h1>
    <form action="/admin/users/" method="post">
        @method('post')
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="firstName">Voornaam</label>
                    <input type="text" name="firstName" id="firstName"
                        class="form-control @error('firstName') is-invalid @enderror" placeholder="Voornaam" required
                        value="{{ old('firstName', $user->firstName) }}">
                    @error('firstName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="surname">Achternaam</label>
                    <input type="text" name="surname" id="surname"
                        class="form-control @error('surname') is-invalid @enderror" placeholder="Achternaam" minlength="2"
                        maxlength="255" required value="{{ old('surname', $user->surname) }}">
                    @error('surname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="email" minlength="2" maxlength="255" required
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="telephone">Telefoonnummer</label>
                    <input type="text" name="telephone" id="telephone"
                        class="form-control @error('telephone') is-invalid @enderror" placeholder="Telefoonnummer"
                        minlength="8" maxlength="16" required value="{{ old('telephone', $user->telephone) }}">
                    @error('telephone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="address">Adres</label>
                    <input value="{{ old('address', $user->address) }}" type="text" name="address" id="address"
                        class="form-control @error('address') is-invalid @enderror" placeholder="Adres" minlength="2"
                        maxlength="255" required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="place">Plaats</label>
                    <input value="{{ old('place', $user->place) }}" type="text" name="place" id="place"
                        class="form-control @error('place') is-invalid @enderror" placeholder="Plaatsnaam" minlength="3"
                        maxlength="255" required>
                    @error('place')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="postalCode">Postcode</label>
                    <input value="{{ old('postalCode', $user->postalCode) }}" type="text" name="postalCode"
                        id="postalCode" class="form-control @error('postalCode') is-invalid @enderror"
                        placeholder="Postcode" minlength="4" maxlength="255" required>
                    @error('postalCode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="sex">Geslacht</label>
                    <select class="form-control" name="sex" id="sex">
                        <option value="M">M</option>
                        <option value="V">V</option>
                        <option value="X">X</option>
                    </select>
                    @error('sex')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="password">Wachtwoord</label>
                    <input value="{{ old('password', $user->password) }}" type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" placeholder="Wachtwoord" minlength="8"
                        maxlength="255" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="active">Actief</label>
                    <input value="{{ old('active', $user->active) }}" type="checkbox" name="active" id="active"
                        class="form-check" checked>
                    @error('active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="admin">Administrator</label>
                    <input value="{{ old('admin', $user->admin) }}" type="checkbox" name="admin" id="admin"
                        class="form-check">
                    @error('admin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save mr-1"></i> Opslaan</button>
    </form>
@endsection
