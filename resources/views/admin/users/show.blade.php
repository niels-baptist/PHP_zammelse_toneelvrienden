@extends('layouts.template')
@section('main')
    <a href="/admin/users" class="btn btn-primary"><i class="fas fa-arrow-left mr-1"></i> Terug</a>
    <br><br>
    <h1>Medewerker {{ $user->firstName }} {{ $user->surname }} Bekijken</h1>
    <form action="/admin/users/{{ $user->id }}" method="post">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="firstName">Voornaam</label>
                    <input type="text" name="firstName" id="firstName"
                        class="form-control @error('firstName') is-invalid @enderror" placeholder="Voornaam" minlength="1"
                        maxlength="50" required value="{{ old('firstName', $user->firstName) }}">
                    @error('firstName')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="surname">Achternaam</label>
                    <input type="text" name="surname" id="surname"
                        class="form-control @error('surname') is-invalid @enderror" placeholder="Achternaam" minlength="1"
                        maxlength="50" required value="{{ old('surname', $user->surname) }}">
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
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        maxlength="50" placeholder="email" minlength="5" required
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="telephone">Telefoonnummer</label>
                    <input type="tel" name="telephone" id="telephone"
                        class="form-control @error('telephone') is-invalid @enderror" placeholder="Telefoonnummer"
                        minlength="9" maxlength="15" required value="{{ old('telephone', $user->telephone) }}">
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
                    <input type="text" name="address" id="address"
                        class="form-control @error('address') is-invalid @enderror" placeholder="Adres" minlength="3"
                        required pattern="\w+\s+\d{1,5}" value="{{ old('address', $user->address) }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="place">Plaats</label>
                    <input type="text" name="place" id="place" class="form-control @error('place') is-invalid @enderror"
                        placeholder="Plaatsnaam" minlength="3" required value="{{ old('place', $user->place) }}">
                    @error('place')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="postalCode">Postcode</label>
                    <input type="number" name="postalCode" id="postalCode"
                        class="form-control @error('postalCode') is-invalid @enderror" placeholder="Postcode" maxlength="4"
                        minlength="4" required value="{{ old('postalCode', $user->postalCode) }}">
                    @error('postalCode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="sex">Geslacht</label>
                    <select id="sex" name="sex" class="form-control">
                        <option value="M" {{ $user->sex == 'M' ? 'selected' : '' }}>M</option>
                        <option value="V" {{ $user->sex == 'V' ? 'selected' : '' }}>V</option>
                        <option value="X" {{ $user->sex == 'X' ? 'selected' : '' }}>X</option>
                    </select>
                    @error('sex')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="active">Actief</label>
                    <input type="checkbox" name="active" id="active" disabled
                        class="form-check @error('active') is-invalid @enderror"
                        {{ old('active', $user->active ? 'checked' : '') }}>
                    @error('active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="admin">Administrator</label>
                    <input disabled type="checkbox" name="admin" id="admin"
                        class="form-check @error('admin') is-invalid @enderror"
                        {{ old('admin', $user->admin ? 'checked' : '') }}>
                    @error('admin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </form>
@endsection
