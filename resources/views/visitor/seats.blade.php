<div class="form-group">
    <label for="performance_id">Selecteer een voorstelling</label>
    <select name="performance_id" id="performance_id"
            class="custom-select @error('selected') is-invalid @enderror"
            required>
        <option value="-1">Selecteer een voorstelling</option>
        @foreach($performances as $performance)
            @if($performance->tickets_count > 0)
                <option value="{{ $performance->id }}">{{ ucfirst($performance->play->name) }} {{ $performance->dateTime }}</option>
            @endif
        @endforeach
    </select>
</div>

@error('selected')
<div class="invalid-feedback d-block">{{ $message }}</div>
@enderror

@foreach($performances as $performance)
    @if($performance->tickets_count > 0)
        <div id="performance-{{$performance->id}}" class="performance d-none">
            <h1>{{$performance->play->name}}</h1>
            <div class="row justify-content-between">
                <p class="col-md-5"><b>Speeldatum: </b>{{$performance->date}} <br>
                    <b>Startuur: </b>{{$performance->time}}</p>
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
            </div>
            <div class="seat-container">
                @php $previousfloor = ''; @endphp
                @php $newRow = 0; @endphp
                @foreach($performance->tickets as $ticket)
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
                        @if($ticket->reservation_id || $ticket->active == false)
                            <div class="d-flex align-items-center justify-content-center flex-column">
                                <input type="checkbox" class="taken-seat mb-1" name="selected[{{$ticket->id}}]"
                                       id="checkbox-{{$ticket->id}}" disabled checked>
                                <label for="checkbox-{{$ticket->id}}">
                                <span class="fa-stack" data-toggle="tooltip" title="Ticket is al bezet">
                                    <i class="fas fa-chair fa-stack-1x"></i>
                                    <i class="fas fa-ban fa-stack-2x" style="color:Tomato"></i>
                                </span>

                                </label>
                                <span>{{$ticket->chair->chairNumber}}</span>
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center flex-column">
                                <input type="checkbox" class="available-seat mb-1" name="selected[{{$ticket->id}}]"
                                       id="checkbox-{{$ticket->id}}">
                                <label for="checkbox-{{$ticket->id}}">
                                <span class="fa-stack" data-toggle="tooltip" title="Ticket is reserveerbaar">
                                    <i class="fas fa-chair fa-stack-1x"></i>
                                    <i class="far fa-circle fa-stack-2x" style="color:lightgray"></i>
                                </span>

                                </label>
                                <span>{{$ticket->chair->chairNumber}}</span>
                            </div>
                        @endif
                    </div>
                    @php $previousfloor = $ticket->chair->floor @endphp
                    @php $newRow = 0 @endphp
                @endforeach
            </div>
        </div>
            <hr>
        </div>
    @endif
    @if($performance->tickets_count <= 0)
        <div id="WrnNoTickets" class="alert alert-warning d-none">Helaas! Alle tickets zijn uitverkocht.
            Voor vragen kan je telefonisch contact opnement met <a href="tel:0474501230">0474501230</a></div>
    @endif
@endforeach
@section('script_after')
    <script>
        $("#performance_id").on('change', () => {
            const selectedPerformanceId = $("#performance_id").val();
            $('.performance').not('d-none').addClass('d-none');
            $(`#performance-${selectedPerformanceId}`).toggleClass('d-none');

            $('.available-seat').prop('checked', false);


            $('.detail-input').prop('disabled', false);
            if (selectedPerformanceId == -1) {
                $('.detail-input').prop('disabled', true);
            }
        })

        $(function () {
                var length = $('#performance_id').children('option').length;
                if (length - 1 === 0) {
                    $("#WrnNoTickets").removeClass("d-none");
                }
            }
        );
    </script>
@endsection
