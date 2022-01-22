@extends('layouts.template')
@section('main')
    <h1>Voorstellingen Beheren</h1>
    @include('shared.alert')
    <p>
        <a href="/admin/performances/create" class="btn btn-primary" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>Nieuwe Voorstelling Aanmaken
        </a>
        <button type="button" data-toggle="modal" data-target=".modalPerformance"
            class="btn btn-outline-primary float-right">
            <i class="fab fa-youtube"></i> Hulpvideo
        </button>
    </p>
    <form method="get" action="/admin/performances" id="searchForm">
        <div class="row">
            <div class="col-sm-4 mb-2">
                <select class="form-control" name="hall_id" id="hall">
                    <option value="%" selected>Alle zalen</option>
                    @foreach ($halls as $hall)
                        <option value="{{ $hall->id }}" {{ request()->hall_id == $hall->id ? 'selected' : '' }}>
                            {{ $hall->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4 mb-2">
                <select class="form-control" name="play_id" id="play">
                    <option value="%" selected>Alle toneelstukken</option>
                    @foreach ($plays as $play)
                        <option value="{{ $play->id }}" {{ request()->play_id == $play->id ? 'selected' : '' }}>
                            {{ $play->year }} | {{ $play->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3 mb-2">
                <select class="form-control" name="sort_by" id="sort_by">
                    <option value="date_asc" {{ request()->sort_by == 'date_asc' ? 'selected' : '' }}>Datum (oplopend)
                    </option>
                    <option value="date_desc" {{ request()->sort_by == 'date_desc' ? 'selected' : '' }}>Datum
                        (aflopend)</option>
                    <option value="price_asc" {{ request()->sort_by == 'price_asc' ? 'selected' : '' }}>Prijs
                        (oplopend)</option>
                    <option value="price_desc" {{ request()->sort_by == 'price_desc' ? 'selected' : '' }}>Prijs
                        (aflopend)</option>
                    <option value="tickets_count_desc"
                        {{ request()->sort_by == 'tickets_count_desc' ? 'selected' : '' }}>Beschikbare plaatsen
                        (oplopend)</option>
                    <option value="tickets_count_asc" {{ request()->sort_by == 'tickets_count_asc' ? 'selected' : '' }}>
                        Beschikbare plaatsen
                        (aflopend)</option>
                    <option value="inactive" {{ request()->sort_by == 'inactive' ? 'selected' : '' }}>Inactief
                    </option>
                </select>
            </div>
            <div class="col-sm-1 mb-2 justify-content-center">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Zoeken">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Zaal</th>
                    <th>Toneelstuk</th>
                    <th>Datum</th>
                    <th>Startuur</th>
                    <th>Prijs</th>
                    <th>Beschikbare plaatsen</th>
                    <th>Actief</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($performances as $performance)
                    <tr>
                        <td>{{ $performance->hall->name }}</td>
                        <td>{{ $performance->play->name }}</td>
                        <td>{{ $performance->date }}</td>
                        <td>{{ $performance->time }}</td>
                        <td>€ {{ $performance->price }}</td>
                        <td>
                            {{ $performance->available_tickets }} / {{ $performance->active_tickets }}
                        </td>
                        <td>
                            @if ($performance->active)
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas fa-times"></i>
                            @endif
                        </td>
                        <td>
                            <form action="/admin/performances/{{ $performance->id }}" method="post">
                                @method('delete')
                                @csrf
                                <div>
                                    <a href="/admin/performances/{{ $performance->id }}/edit"
                                       class="btn btn-sm btn-outline-primary" data-toggle="tooltip"
                                       title="Voorstelling Bewerken">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="/admin/performances/{{ $performance->id }}"
                                       class="btn btn-sm btn-outline-warning" data-toggle="tooltip"
                                       title="Tickets Bewerken">
                                        <i class="fas fa-chair"></i>
                                    </a>

                                    <a href="/admin/tickets/{{ $performance->id }}/pdf"
                                       class="btn btn-sm btn-outline-info" data-toggle="tooltip"
                                       title="Overzicht Afprinten">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <button type="button" class="deletePerformance btn btn-sm btn-outline-danger"
                                            data-tickets-taken="{{ $performance->tickets_count }}" data-toggle="tooltip"
                                            title="Voorstelling Verwijderen">
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

    @if ($performances->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Er kan geen voorstelling gevonden worden </b>
            @foreach ($plays as $play)
                @if (request()->play_id == $play->id)
                    voor het toneelstuk <b>'{{ $play->name }}'</b>
                @endif
            @endforeach
            @foreach ($halls as $hall)
                @if (request()->hall_id == $hall->id)
                    in de zaal <b>'{{ $hall->name }}'</b>
                @endif
            @endforeach
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="modal fade modalPerformance" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hulpvideo Voorstellingen Beheren</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe width="100%" height="600"
                            src="https://www.youtube.com/embed/CJdwWFe-LEI?list=PL5DZvsFexpNYOLIQMcTeUA4FI1afoDmFy"
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
            $('.deletePerformance').click(function() {
                let tickets_taken = $(this).data('tickets-taken');
                let msg =
                    `Weet u zeker dat u deze voorstelling wilt verwijderen? \nDeze actie kan niet ontdaan worden!`;
                if (tickets_taken == 1) {
                    msg +=
                        `\nLet op: Er is al een ticket gereserveerd voor deze voorstelling! Deze zal mee verwijderd worden!`
                } else if (tickets_taken > 1) {
                    msg +=
                        `\nLet op: Er zijn al <b>${tickets_taken}</b> tickets gereserveerd voor deze voorstelling! Deze zullen mee verwijderd worden!`
                }
                if (confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })

            // submit form when leaving dropdown lists'
            $('#hall, #play, #sort_by').change(function() {
                $('#searchForm').submit();
            });
        });
    </script>
@endsection
