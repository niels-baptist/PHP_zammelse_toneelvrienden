@extends('layouts.template')
@section('main')
    <h1>Zalen Beheren</h1>
    @include('shared.alert')
    <p>
        <a href="/admin/halls/create" class="btn btn-primary" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>Nieuwe Zaal Aanmaken
        </a>
        <button type="button" data-toggle="modal" data-target=".modalHall" class="btn btn-outline-primary float-right">
            <i class="fab fa-youtube"></i> Hulpvideo
        </button>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Adres</th>
                    <th>Capaciteit</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($halls as $hall)
                    <tr>
                        <td>{{ $hall->name }}</td>
                        <td>{{ $hall->address }} {{ $hall->postalCode }} {{ $hall->place }}</td>
                        <td>{{ $hall->capacity }}</td>
                        <td>
                            <form action="/admin/halls/{{ $hall->id }}" method="post">
                                @csrf
                                @method('delete')
                                <div>
                                    <a href="/admin/halls/{{ $hall->id }}/edit" class="btn btn-sm btn-outline-primary"
                                        data-toggle="tooltip" title="Zaal Bewerken">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger deleteHall"
                                        data-toggle="tooltip" data-name="{{ $hall->name }}" title="Zaal Verwijderen">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($halls->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Er zijn geen zalen gevonden.

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="modal fade modalHall" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hulpvideo Zaal Beheren</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe width="100%" height="600"
                            src="https://www.youtube.com/embed/n6m1qQuwbqg?list=PL5DZvsFexpNYOLIQMcTeUA4FI1afoDmFy"
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
@section('script_after')
    <script>
        $(function() {
            $('.deleteHall').click(function() {
                let name = $(this).data("name");
                const msg = `Weet u zeker dat u de zaal "${name}" wilt verwijderen? \nDeze actie kan niet ontdaan worden!`;
                if (confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })
        });
    </script>
@endsection
