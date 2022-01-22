@extends('layouts.template')

@section('main')
    <h1>Veelgestelde Vragen</h1>
    <div id="accordion">
        {{-- Ordering tickets --}}
        <div class="card">
            <div class="card-header" id="headingOrderTickets">
                <h5 class="mb-0 w-100">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOrderTickets"
                        aria-expanded="true" aria-controls="collapsePlay">
                        <i class="fas fa-ticket-alt"></i> Vragen over tickets boeken
                    </button>
                    <button type="button" data-toggle="modal" data-target=".modalOrderTickets"
                        class="btn btn-outline-primary float-right"><i class="fab fa-youtube"></i> Hulpvideo</button>
                </h5>
            </div>
            <div id="collapseOrderTickets" class="collapse show" aria-labelledby="headingPlay" data-parent="#accordion">
                <div class="card-body">
                    <h6>Hoe reserveer ik tickets voor een voorstelling?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/">Home</a>.</li>
                        <li>Kies een voorstelling en klik op de knop <span class="font-weight-bold">"Tickets Boeken"</span>.
                        </li>
                        <li>Selecteer een voorstelling.</li>
                        <li>Selecteer in het zaalplan één of meerdere stoelen die u wilt reserveren.</li>
                        <li>Vul uw achternaam, voornaam, e-mailadres, telefoonnummer, adres, gemeente en postcode in.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Reserveren"</span>.</li>
                        <li>Uw reservatie is nu voltooid. Er wordt een bevestigingsmail gestuurd naar uw e-mailadres.</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

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
