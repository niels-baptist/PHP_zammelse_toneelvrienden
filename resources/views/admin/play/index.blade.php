@extends('layouts.template')
@section('main')
    <h1>Toneelstukken Beheren</h1>
    @include('shared.alert')
    <p>
        <a href="/admin/play/create" class="btn btn-primary">
            <i class="fas fa-plus-circle mr-1"></i>Nieuw Toneelstuk Aanmaken
        </a>
        <button type="button" data-toggle="modal" data-target=".modalPlay" class="btn btn-outline-primary float-right">
            <i class="fab fa-youtube"></i> Hulpvideo
        </button>
    </p>

    <form method="get" action="/admin/play" id="searchForm">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="playName" id="playName" value="{{ request()->playName }}"
                    placeholder="Filter op naam">
            </div>
            <div class="col-sm-5 mb-2">
                <select class="form-control" name="sort_by" id="sort_by">
                    <option value="name_asc" {{ request()->sort_by == 'name_asc' ? 'selected' : '' }}>Naam
                        (oplopend)
                    </option>
                    <option value="name_desc" {{ request()->sort_by == 'name_desc' ? 'selected' : '' }}>Naam
                        (aflopend)
                    </option>
                    <option value="year_asc" {{ request()->sort_by == 'year_asc' ? 'selected' : '' }}>Jaargang
                        (oplopend)
                    </option>
                    <option value="year_desc" {{ request()->sort_by == 'year_desc' ? 'selected' : '' }}>Jaargang
                        (aflopend)
                    </option>
                    <option value="inactive" {{ request()->sort_by == 'inactive' ? 'selected' : '' }}>Inactief
                    </option>
                </select>
            </div>
            <div class="col-sm-12 col-md-1 mb-2 justify-content-center">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Zoeken">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="form-group table-responsive" style="max-height: 400px">
        <table class="table">
            <thead>
                <tr>
                    <th>Toneelstuk</th>
                    <th>Jaargang</th>
                    <th>Actief</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plays as $play)
                    <tr>
                        <td><a href="/admin/play/{{ $play->id }}">{{ $play->name }}</a< /td>
                        <td>{{ $play->year }}</td>
                        <td>
                            @if ($play->active == true)
                                <p class="col-2"><i class="fas fa-check"></i></p>
                            @else
                                <p class="col-2"><i class="fas fa-times"></i></p>
                            @endif
                        </td>
                        <td>
                            <form action="/admin/play/{{ $play->id }}" method="post">
                                @method('delete')
                                @csrf
                                <div>
                                    <a href="/admin/play/{{ $play->id }}/edit" class="btn btn-sm btn-outline-primary"
                                        data-toggle="tooltip" title="Toneelstuk Bewerken">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/admin/play/{{ $play->id }}/roles" class="btn btn-sm btn-outline-warning"
                                        data-toggle="tooltip" title="Rollen Bewerken">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger deletePlay"
                                        data-toggle="tooltip" data-name="{{ $play->name }}"
                                        title="Toneelstuk Verwijderen">
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

    @if ($plays->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Er kan geen toneelstuk gevonden worden met <b>'{{ request()->playName }}'</b>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="modal fade modalPlay" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hulpvideo Toneelstukken Beheren</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe width="100%" height="600"
                            src="https://www.youtube.com/embed/jS5bkg05DTk?list=PL5DZvsFexpNYOLIQMcTeUA4FI1afoDmFy"
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
            $('.deletePlay').click(function() {
                let name = $(this).data('name');
                let msg = `Weet u zeker dat u het toneelstuk "${name}" wilt verwijderen? \nDeze actie kan niet ontdaan worden!`;

                if (confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })

            // submit form when leaving text field / dropdown lists
            $('#playName').blur(function() {
                $('#searchForm').submit();
            });
            $('#sort_by').change(function() {
                $('#searchForm').submit();
            });
        });
    </script>
@endsection
