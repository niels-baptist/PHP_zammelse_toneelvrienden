@extends('layouts.template')
@section('main')
    <div class="mb-2">
        <h1 class="d-inline">Profiel Bewerken</h1>
        <button type="button" data-toggle="modal" data-target=".modalProfile"
            class="btn btn-outline-primary mt-1 float-right">
            <i class="fab fa-youtube"></i> Hulpvideo
        </button>
    </div>
    @include('shared.alert')
    <form action="/user/profile" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="firstName">Voornaam</label>
                    <input type="text" name="firstName" id="firstName"
                        class="form-control @error('firstName') is-invalid @enderror" placeholder="Voornaam" minlength="1"
                        maxlength="50" required value="{{ old('firstName', auth()->user()->firstName) }}">
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
                        maxlength="50" required value="{{ old('surname', auth()->user()->surname) }}">
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
                        value="{{ old('email', auth()->user()->email) }}">
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
                        minlength="9" maxlength="15" required value="{{ old('telephone', auth()->user()->telephone) }}">
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
                        required value="{{ old('address', auth()->user()->address) }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="place">Plaats</label>
                    <input type="text" name="place" id="place" class="form-control @error('place') is-invalid @enderror"
                        placeholder="Plaatsnaam" minlength="3" required
                        value="{{ old('place', auth()->user()->place) }}">
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
                        minlength="4" required value="{{ old('postalCode', auth()->user()->postalCode) }}">
                    @error('postalCode')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="sex">Geslacht</label>
                    <select id="sex" name="sex" class="form-control">
                        <option value="M" {{ auth()->user()->sex == 'M' ? 'selected' : '' }}>M</option>
                        <option value="V" {{ auth()->user()->sex == 'V' ? 'selected' : '' }}>V</option>
                        <option value="X" {{ auth()->user()->sex == 'X' ? 'selected' : '' }}>X</option>
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
                    <input type="checkbox" name="active" id="active"
                        class="form-check @error('active') is-invalid @enderror"
                        {{ old('active', auth()->user()->active ? 'checked' : '') }}>
                    @error('active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="form-group">
                    <label for="admin">Administrator</label>
                    <input type="checkbox" name="admin" id="admin" class="form-check @error('admin') is-invalid @enderror"
                        {{ old('admin', auth()->user()->admin ? 'checked' : '') }}>
                    @error('admin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save mr-1"></i> Opslaan</button>
    </form>

    <div class="modal fade modalProfile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hulpvideo Profiel Beheren</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe width="100%" height="600"
                            src="https://www.youtube.com/embed/af8ENMmXA-Y?list=PL5DZvsFexpNYOLIQMcTeUA4FI1afoDmFy"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12"><button type="button" class="btn btn-secondary float-right"
                            data-dismiss="modal">Sluiten</button></div>
                </div>
            </div>
        </div>
    </div>
@endsection
