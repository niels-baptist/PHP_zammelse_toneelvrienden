@extends('layouts.template')
@section('main')
    <h1 class="p-2">Toneelstuk {{ $playRequest->name }}</h1>
    <div class="row">
        <section class="col-sm-12 col-lg-6">
            <h2>Toneelstuk</h2>
            <div class="form-group">
                <h4>Naam</h4>
                <h5>{{ $playRequest->name }}</h5>
            </div>
            <hr>
            <div class="form-group">
                <h4>Beschrijving</h4>
                <p>{{ $playRequest->description }}</p>
            </div>
            <hr>
            <div class="form-group">
                <h4>Jaargang</h4>
                <p>{{ $playRequest->year }}</p>
            </div>
            <hr>
            <div class="form-group">
                <h4>Speeltijd in minuten</h4>
                <p>{{ $playRequest->playtime }}</p>
            </div>
        </section>
        <section class="col-sm-12 col-lg-6">
            <h2>Rollen</h2>
            <div class="form-group">
                <div class="form-group table-responsive" style="max-height: 340px !important;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Personage</th>
                                <th>Rol</th>
                                <th>Medewerker</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($playRequest->playroles as $role)
                                <tr>
                                    <td>{{ $role->character }}</td>
                                    <td>{{ $role->job->name }}</td>
                                    <td>{{ $role->user->firstName }} {{ $role->user->surname }}</td>
                                    <td>
                                        <form action="/admin/roles/{{ $role->id }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-outline-danger deleteRol"
                                                data-toggle="tooltip" data-name="{{ $role->character }}"
                                                title="Delete {{ $role->character }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr class="p-3">
                <div class="row justify-content-around">
                    <a href="/admin/play/{{ $playRequest->id }}/edit" class="btn btn-outline-primary col-5 m-2">
                        Toneelstuk Bewerken
                    </a>
                    <a href="/admin/play/{{ $playRequest->id }}/roles" class="btn btn-outline-primary col-5 m-2">
                        Rollen Bewerken
                    </a>
                </div>
            </div>
        @endsection
