@extends('layouts.template')
@section('main')
    <h2>Tickets van {{ $reservation->firstName }} {{ $reservation->surname }} Aanpassen:</h2>
    <form action="/admin/tickets/" method="POST" id="searchForm">
        @csrf
        <hr>
        <input type="hidden" id="reservationId" name="reservationId" value="{{ $reservation->id}}">
        <div class="row justify-content-between">
            <p class="col-md-4">
                <span class="fa-stack">
                    <i class="fas fa-chair fa-stack-1x"></i>
                    <i class="far fa-circle fa-stack-2x" style="color:lightgray"></i>
                </span> Beschikbare Zitplaats
            </p>
            <p class="col-md-4">
                <span class="fa-stack">
                    <i class="fas fa-chair fa-stack-1x"></i>
                    <i class="fas fa-ban fa-stack-2x" style="color:Tomato"></i>
                </span> Inactieve of bezette Zitplaats
            </p>
            <p class="col-md-4">
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
            @foreach ($tickets as $ticket)
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
                @if ($ticket->reservation_id == $reservation->id)
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <input type="checkbox" class="mb-1" name="selected[{{ $ticket->id }}]"
                            id="checkbox-{{ $ticket->id }}" checked>
                        <label for="checkbox-{{ $ticket->id }}">
                            <span class="fa-stack" data-toggle="tooltip" title="Ticket hoort momenteel bij deze reservatie">
                                <i class="fas fa-chair fa-stack-1x"></i>
                                <i class="far fa-circle fa-stack-2x" style="color:lightgray"></i>
                            </span>
                        </label>
                        <span>{{ $ticket->chair->chairNumber }}</span>
                    </div>
                @elseif($ticket->reservation_id || $ticket->active == false)
                    <div class="d-flex align-items-center justify-content-center flex-column">
                        <input type="checkbox" class="mb-1" name="selected[{{ $ticket->id }}]"
                            id="checkbox-{{ $ticket->id }}" checked disabled>
                        <label for="checkbox-{{ $ticket->id }}">
                            <span class="fa-stack" data-toggle="tooltip" title="Ticket is bezet of inactief">
                                <i class="fas fa-chair fa-stack-1x"></i>
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
        <button type="submit" id="submit" class="btn btn-primary mt-3"><i class="fas fa-save mr-1"></i> Opslaan</button>
    </form>
    <hr>
@endsection
