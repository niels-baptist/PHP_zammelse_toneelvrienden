@extends('layouts.template')
@section('main')
    <h1>{{ $playRequest->name }}: Rollen Toewijzen</h1>
    @include('shared.alert')
    <h2>Rollen</h2>
    <div class="form-group table-responsive" style="max-height: 180px !important;">
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
                                <button type="button" class="btn btn-outline-danger deleteRol" data-toggle="tooltip"
                                    data-name="{{ $role->character }}" title="Rol Verwijderen">

                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form action="/admin/addRole" method="post">
        <input type="hidden" name="play_id" id="play_id" value="{{ $playRequest->id }}">
        @include("admin.play.role.form")
    </form>
@endsection
@section('script_after')
    <script>
        $(function() {
            $('.deleteRol').click(function() {
                let name = $(this).data('name');
                let msg = `Weet u zeker dat u deze rol wilt verwijderen? \nDeze actie kan niet ontdaan worden!`;

                if (name != "") {
                    msg = `Weet u zeker dat u de rol "${name}" wilt verwijderen? \nDeze actie kan niet ontdaan worden!`;
                }

                if (confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })
        });
    </script>
@endsection
