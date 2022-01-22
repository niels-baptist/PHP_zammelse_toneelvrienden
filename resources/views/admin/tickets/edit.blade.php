@extends('layouts.template')
@section('main')
    <h2>Tickets Bewerken</h2>
    <p>Selecteer één of meerdere tickets en druk op een knop hieronder om de tickets aan te passen.</p>

    <form action="/admin/tickets/" method="GET" id="searchForm">
        @csrf
        <div class="row my-2">
            <div class="btn-group mx-1">
                <button type="submit" id="submit" class="btn btn-outline-primary" name="control" value="inactief"
                    data-toggle="tooltip" title="Geselecteerde tickets op inactief zetten">INACTIEF
                </button>

                <button type="submit" id="submit" class="btn btn-outline-primary" name="control" value="actief"
                    data-toggle="tooltip" title="Geselecteerde tickets op actief zetten">ACTIEF
                </button>
            </div>
            <div class="btn-group mx-1">
                <button type="submit" id="submit" class="btn btn-outline-primary" name="control" value="rolstoeltoegankelijk"
                    data-toggle="tooltip" title="Geselecteerde tickets op rolstoeltoegankelijk zetten">ROLSTOELTOEGANKELIJK
                </button>

                <button type="submit" id="submit" class="btn btn-outline-primary" name="control" value="normaal"
                    data-toggle="tooltip" title="Geselecteerde tickets op normaal zetten">NORMAAL
                </button>
            </div>

            <div class="col-sm-5 mb-2">
                <select class="form-control" name="performance_id" id="performanceSearch">
                    @foreach ($performances as $perfor)
                        <option value="{{ $perfor->id }}"
                            {{ request()->performance_id == $perfor->id ? 'selected' : '' }} ?
                            {{ $performance->id == $perfor->id ? 'selected' : '' }}>
                            {{ $perfor->play->name }} | {{ $perfor->dateTime }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <button type="submit" id="submit" class="btn btn-outline-primary" name="control" data-toggle="tooltip"
                    title="Zoeken op voorstelling">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <hr>

        <div class="row justify-content-between">
            <p class="col-md-3">
                <span class="fa-stack">
                    <i class="fas fa-chair fa-stack-1x"></i>
                    <i class="far fa-circle fa-stack-2x" style="color:lightgray"></i>
                </span> Beschikbare Zitplaats
            </p>
            <p class="col-md-3">
                <span class="fa-stack">
                    <i class="fas fa-chair fa-stack-1x"></i>
                    <i class="fas fa-ban fa-stack-2x" style="color:#ff6347"></i>
                </span> Bezette Zitplaats
            </p>
            <p class="col-md-3">
                <span class="fa-stack">
                    <i class="fas fa-chair fa-stack-1x"></i>
                    <i class="far fa-circle fa-stack-2x" style="color:Tomato"></i>
                </span> Inactieve Zitplaats
            </p>
            <p class="col-md-3">
                <span class="fa-stack">
                    <i class="fas fa-wheelchair fa-stack-1x"></i>
                    <i class="far fa-circle fa-stack-2x" style="color:Blue"></i>
                </span> Rolstoeltoegankelijke Zitplaats
            </p>
        </div>
        <hr>

        <div class="seat-container">
            @php $previousfloor = ''; @endphp
            @php $newRow = 0; @endphp
            @foreach ($performance->tickets as $ticket)
            @if ($loop->index !== 0 && $newRow === 0 && $previousfloor !== $ticket->chair->floor)
                </div>
            @endif
            @if($previousfloor !== $ticket->chair->floor)
            @php $newRow = 1; @endphp
                <div class="pb-5">
                    <div class="my-2 position-absolute"><b>{{$ticket->chair->floor === 0 ? "Gelijkvloers" : "Verhoog " . $ticket->chair->floor}}</b></div>
                </div>
                <div class="seat-group">
            @endif
            <div class="seat">
                @if ($ticket->reservation_id)
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <input type="checkbox" class="mb-1" name="selected[{{ $ticket->id }}]"
                            id="checkbox-{{ $ticket->id }}" checked disabled>
                        <label for="checkbox-{{ $ticket->id }}">
                            <span class="fa-stack" data-toggle="tooltip" title="Ticket is al bezet">
                                <i class="fas fa-chair fa-stack-1x"></i>
                                <i class="fas fa-ban fa-stack-2x" style="color:Tomato"></i>
                            </span>
                        </label>
                        <span>{{ $ticket->chair->chairNumber }}</span>
                    </div>

                @elseif($ticket->active == false)
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <input type="checkbox" class="mb-1" name="selected[{{ $ticket->id }}]"
                            id="checkbox-{{ $ticket->id }}">
                        <label for="checkbox-{{ $ticket->id }}">
                            <span class="fa-stack" data-toggle="tooltip" title="Ticket staat op inactief">
                                <i class="fas fa-chair fa-stack-1x"></i>
                                <i class="far fa-circle fa-stack-2x" style="color:Tomato"></i>
                            </span>
                        </label>
                        <span>{{ $ticket->chair->chairNumber }}</span>
                    </div>

                @elseif($ticket->wheelchairAccessible == true && $ticket->reservation_id)
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <input type="checkbox" class="mb-1" name="selected[{{ $ticket->id }}]"
                            id="checkbox-{{ $ticket->id }}">
                        <label for="checkbox-{{ $ticket->id }}">
                            <span class="fa-stack" data-toggle="tooltip" title="Ticket is rolstoeltoegankelijk en bezet">
                                <i class="fas fa-wheelchair fa-stack-1x"></i>
                                <i class="fas fa-ban fa-stack-2x" style="color:Tomato"></i>
                            </span>
                        </label>
                        <span>{{ $ticket->chair->chairNumber }}</span>
                    </div>

                @elseif($ticket->wheelchairAccessible == true)
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <input type="checkbox" class="mb-1" name="selected[{{ $ticket->id }}]"
                            id="checkbox-{{ $ticket->id }}">
                        <label for="checkbox-{{ $ticket->id }}">
                            <span class="fa-stack" data-toggle="tooltip" title="Ticket is rolstoeltoegankelijk">
                                <i class="fas fa-wheelchair fa-stack-1x"></i>
                                <i class="far fa-circle fa-stack-2x" style="color:Blue"></i>
                            </span>
                        </label>
                        <span>{{ $ticket->chair->chairNumber }}</span>
                    </div>
                @else
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <input type="checkbox" class="mb-1" name="selected[{{ $ticket->id }}]"
                            id="checkbox-{{ $ticket->id }}">
                        <label for="checkbox-{{ $ticket->id }}">
                            <span class="fa-stack" data-toggle="tooltip" title="Ticket is reserveerbaar">
                                <i class="fas fa-chair fa-stack-1x"></i>
                                <i class="far fa-circle fa-stack-2x" style="color:lightgray"></i>
                            </span>
                        </label>
                        <span>{{ $ticket->chair->chairNumber }}</span>
                    </div>
                @endif
            </div>
        @php $previousfloor = $ticket->chair->floor @endphp
        @php $newRow = 0 @endphp
        @endforeach
        </div>
    </form>
    <hr>
@endsection
