@extends('layouts.template')

@section('main')
    <div class="mb-2">
        <h1 class="d-inline">Wachtwoord Wijzigen</h1>
        <button type="button" data-toggle="modal" data-target=".modalProfile"
            class="btn btn-outline-primary mt-1 float-right">
            <i class="fab fa-youtube"></i> Hulpvideo
        </button>
    </div>
    @include('shared.alert')
    <form action="/user/password" method="post">
        @csrf
        <div class="form-group">
            <label for="current_password">Huidig wachtwoord</label>
            <input type="password" name="current_password" id="current_password"
                class="form-control @error('current_password') is-invalid @enderror" placeholder="Huidig wachtwoord"
                value="{{ old('current_password') }}" required>
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Nieuw wachtwoord</label>
            <input type="password" name="password" id="password"
                class="form-control @error('password') is-invalid @enderror" placeholder="Nieuw wachtwoord"
                value="{{ old('password') }}" minlength="8" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Bevestig nieuw wachtwoord</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                placeholder="Bevestig nieuw wachtwoord" value="{{ old('password_confirmation') }}" minlength="8" required>
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
