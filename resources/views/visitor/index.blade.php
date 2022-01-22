@extends('layouts.template')
@section('main')
    <div class="mb-2">
        <h1 class="d-inline">Reservatie Boeken</h1>
        <button type="button" data-toggle="modal" data-target=".modalOrderTickets"
            class="btn btn-outline-primary mt-1 float-right">
            <i class="fab fa-youtube"></i> Hulpvideo
        </button>
    </div>
    <form action="/reservations" method="POST">
        @include('visitor.seats')
        @include('visitor.form')
    </form>

    <div class="modal fade modalOrderTickets" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hulpvideo Tickets Boeken</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe width="100%" height="600" src="https://www.youtube.com/embed/4271nTM9kcw?list=PL5DZvsFexpNYOLIQMcTeUA4FI1afoDmFy" frameborder="0"
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
