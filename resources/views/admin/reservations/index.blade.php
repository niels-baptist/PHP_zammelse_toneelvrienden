@extends('layouts.template')
@section('main')
    <h1>Reservaties Beheren</h1>
    @include('shared.alert')
    <p>
        <a href="/admin/reservations/create" class="btn btn-primary">
            <i class="fas fa-plus-circle mr-1"></i>Nieuwe Reservatie Aanmaken
        </a>
        <button data-toggle="tooltip" title="Kopieer alle mailadressen naar klembord" id="BtnCopyMail"
            class="btn btn-outline-primary float-right ml-1">
            <i class="fas fa-envelope-open-text mr-1"></i>Mailadressen kopiëren
        </button>
        <button type="button" data-toggle="modal" data-target=".modalReservation"
            class="btn btn-outline-primary float-right">
            <i class="fab fa-youtube"></i> Hulpvideo
        </button>
    </p>
    <form method="get" action="/admin/reservations" id="searchForm">
        <div class="row">
            <div class="col-sm-4 mb-2">
                <input type="text" class="form-control" name="reservationName" id="reservationName"
                    value="{{ request()->reservationName }}" placeholder="Filter op naam">
            </div>
            <div class="col-sm-4 mb-2">
                <select class="form-control" name="performance_id" id="performance">
                    <option value="%">Alle Voorstelling</option>
                    @foreach ($performances as $performance)
                        <option value="{{ $performance->id }}"
                            {{ request()->performance_id == $performance->id ? 'selected' : '' }}>
                            {{ ucfirst($performance->play->name) }} {{ $performance->dateTime }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-3 mb-2">
                <select class="form-control" name="sort_by" id="sort_by">
                    <option value="name_asc" {{ request()->sort_by == 'name_asc' ? 'selected' : '' }}>Naam
                        (oplopend)
                    </option>
                    <option value="name_desc" {{ request()->sort_by == 'name_desc' ? 'selected' : '' }}>Naam
                        (aflopend)
                    </option>

                    <option value="payed" {{ request()->sort_by == 'paid' ? 'selected' : '' }}>Betaald Boven
                    </option>
                </select>
            </div>

            <div class="col-sm-12 col-md-1 mb-2 text-center justify-content-center">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Zoeken">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="form-group table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Aantal tickets</th>
                    <th>Toneelstuk</th>
                    <th>Datum</th>
                    <th>Tijdstip</th>
                    <th>Betaald</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->tickets_count }}</td>
                        <td>{{ $reservation->performance->play->name }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ $reservation->time }}</td>
                        <td>{{ $reservation->message }}</td>
                        <td>
                            <form action="/admin/reservations/{{ $reservation->id }}" method="post">
                                @method('delete')
                                @csrf
                                <div>
                                    <a href="/admin/reservations/{{ $reservation->id }}/edit"
                                        class="btn btn-sm btn-outline-primary" data-toggle="tooltip"
                                        title="Reservatie Bewerken">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/admin/reservations/{{ $reservation->id }}"
                                        class="btn btn-sm btn-outline-warning" data-toggle="tooltip"
                                        title="Tickets Bewerken">
                                        <i class="fas fa-ticket-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger deleteReservation"
                                        data-toggle="tooltip" title="Reservatie Verwijderen">
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

    @if ($reservations->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Er kan geen reservatie gevonden worden met <b>'{{ request()->reservationName }}'</b>
            @if (request()->performance_id > 0)
                @foreach ($performances as $performance)
                    @if (request()->performance_id == $performance->id)
                        voor de voorstelling <b>'{{ ucfirst($performance->play->name) }} {{ $performance->dateTime }}
                            '</b>
                    @endif
                @endforeach
            @endif

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div>
        <p style="display: none" id="PMailList">{{ $maillist }}</p>
    </div>

    <div class="modal fade modalReservation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hulpvideo Reservaties Beheren</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe width="100%" height="600"
                            src="https://www.youtube.com/embed/EVCyO8cOo74?list=PL5DZvsFexpNYOLIQMcTeUA4FI1afoDmFy"
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
            // submit form when leaving text field 'reservationName'
            $('#reservationName').blur(function() {
                $('#searchForm').submit();
            });
            // submit form when changing dropdown list 'performance'
            $('#performance, #sort_by').change(function() {
                $('#searchForm').submit();
            });

            $('.deleteReservation').click(function() {
                let msg = `Weet u zeker dat u deze reservatie wilt verwijderen? \nDeze actie kan niet ontdaan worden!`;
                if (confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })

            $('#BtnCopyMail').click(function() {
                copyToClipboard($('#PMailList').text());
            })

            function copyToClipboard(text) {
                var dummy = document.createElement("textarea");
                document.body.appendChild(dummy);
                dummy.value = text;
                dummy.select();
                document.execCommand("copy");
                document.body.removeChild(dummy);
            }
        })
    </script>
@endsection
