@extends('layouts.template')
@section('main')
    <h1>Veelgestelde Vragen</h1>
    <div id="accordion">
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
            <div id="collapseOrderTickets" class="collapse" aria-labelledby="headingPlay" data-parent="#accordion">
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
        <div class="card">
            <div class="card-header" id="headingPlay">
                <h5 class="mb-0 w-100">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsePlay"
                        aria-expanded="true" aria-controls="collapsePlay">
                        <i class="fas fa-microphone-alt"></i> Vragen over toneelstukken
                    </button>
                    <button type="button" data-toggle="modal" data-target=".modalPlay"
                        class="btn btn-outline-primary float-right"><i class="fab fa-youtube"></i> Hulpvideo</button>
                </h5>
            </div>
            <div id="collapsePlay" class="collapse" aria-labelledby="headingPlay" data-parent="#accordion">
                <div class="card-body">
                    <h6>Hoe maak ik een toneelstuk aan?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/play">Toneelstukken</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Nieuw Toneelstuk Aanmaken"</span>.</li>
                        <li>Vul de naam, beschrijving, jaargang, speeltijd in en duid aan of het toneelstuk actief is.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>Nu voeg je de rollen toe, door de naam, de rol en de bijbehorende
                            medewerker te selecteren, en door vervolgens op de knop
                            <span class="font-weight-bold">"Rol Toevoegen"</span> te drukken.
                        </li>
                        <li>Je krijgt een overzicht van de reeds toegevoegde rollen. Hier kan je kiezen om zo nodig nog
                            een rol te verwijderen door op de knop <span class="font-weight-bold">"Rol Verwijderen"</span>
                            te drukken.</li>
                        <li>Als je tevreden bent met de rollen, druk je op de knop <span
                                class="font-weight-bold">"Gereed"</span>.</li>
                        <li>Het nieuwe toneelstuk is nu zichtbaar op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe bewerk ik een bestaand toneelstuk?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/play">Toneelstukken</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Toneelstuk Bewerken"</span>.</li>
                        <li>Pas de gewenste gegevens aan door de inhoud van de velden te veranderen.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>Het toneelstuk is nu gewijzigd te zien op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe bewerk ik de rollen van een bestaand toneelstuk?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/play">Toneelstukken</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Rollen Bewerken"</span>.</li>
                        <li>Je krijgt een overzicht van de reeds toegevoegde rollen. Hier kan je kiezen om zo nodig nog
                            een rol te verwijderen door op de knop <span class="font-weight-bold">"Rol Verwijderen"</span>
                            te drukken.</li>
                        <li>Als je tevreden bent met de rollen, druk je op de knop <span
                                class="font-weight-bold">"Gereed"</span>.</li>
                        <li>Het gewijzigde toneelstuk is nu zichtbaar op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe verwijder ik een bestaand toneelstuk?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/play">Toneelstukken</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Toneelstuk Verwijderen"</span>.</li>
                        <li>Bevestig de actie door in het pop-up venster op de knop <span
                                class="font-weight-bold">"OK"</span> te klikken.</li>
                        <li>Het toneelstuk is nu verdwenen uit de overzichtspagina.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingPerformance">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsePerformance"
                        aria-expanded="false" aria-controls="collapsePerformance">
                        <i class="fas fa-person-booth"></i> Vragen over voorstellingen
                    </button>
                    <button type="button" data-toggle="modal" data-target=".modalPerformance"
                        class="btn btn-outline-primary float-right"><i class="fab fa-youtube"></i> Hulpvideo</button>
                </h5>
            </div>
            <div id="collapsePerformance" class="collapse" aria-labelledby="headingPerformance" data-parent="#accordion">
                <div class="card-body">
                    <h6>Hoe maak ik een voorstelling aan?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/performances">Voorstellingen</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Nieuwe Voorstelling Aanmaken"</span>.</li>
                        <li>Selecteer de zaal en het toneelstuk en vul de datum, startuur en prijs in. Duid ook aan of het
                            toneelstuk actief is.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>De nieuwe voorstelling is nu zichtbaar op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe bewerk ik een bestaande voorstelling?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/performances">Voorstellingen</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Voorstelling Bewerken"</span>.</li>
                        <li>Pas de gewenste gegevens aan door de inhoud van de velden te veranderen.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>De voorstelling is nu gewijzigd te zien op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe maak ik stoelen actief/inactief voor een bestaande voorstelling?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/performances">Voorstellingen</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Tickets Bewerken"</span>.</li>
                        <li>Selecteer de stoelen die u (in)actief wilt maken.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Actief"</span> of <span
                                class="font-weight-bold">"Inactief"</span></li>
                        <li>De geselecteerde stoelen worden nu gewijzigd weergegeven.</li>
                    </ol>
                    <h6>Hoe voorzie of verwijder ik rolstoeltoegankelijke plaatsen voor een bestaande voorstelling?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/performances">Voorstellingen</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Tickets Bewerken"</span>.</li>
                        <li>Selecteer de stoelen die u rolstoeltoegankelijk of terug normaal wilt maken.
                            <span class="d-inline-block"><i class="fas fa-exclamation-triangle"></i> Let op: een
                                rolstoeltoegankelijke plaats neemt 2 stoelen in beslag. Selecteer dus altijd 2
                                aaneengrenzende stoelen!</span>
                        </li>
                        <li>Druk op de knop <span class="font-weight-bold">"Rolstoeltoegankelijk"</span> of <span
                                class="font-weight-bold">"Normaal"</span></li>
                        <li>De geselecteerde stoelen worden nu gewijzigd weergegeven.</li>
                    </ol>
                    <h6>Hoe druk ik een overzicht van de reservaties van een voorstelling af?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/performances">Voorstellingen</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Overzicht afprinten"</span>. Er wordt nu een
                            PDF-bestand gedownload.</li>
                        <li>Open het PDF-bestand en druk op de knop <span class="font-weight-bold">"Print"</span> of gebruik
                            de toestencombinatie <span class="font-weight-bold">"Ctrl + P"</span>.</li>
                        <li>Het overzicht wordt nu voor u afgedrukt.</li>
                    </ol>
                    <h6>Hoe verwijder ik een bestaande voorstelling?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/performances">Voorstellingen</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Voorstelling Verwijderen"</span>.</li>
                        <li>Bevestig de actie door in het pop-up venster op de knop <span
                                class="font-weight-bold">"OK"</span> te klikken.</li>
                        <li>De voorstelling is nu verdwenen uit de overzichtspagina.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingReservation">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseReservation"
                        aria-expanded="false" aria-controls="collapseReservation">
                        <i class="fas fa-clipboard-check"></i> Vragen over reservaties
                    </button>
                    <button type="button" data-toggle="modal" data-target=".modalReservation"
                        class="btn btn-outline-primary float-right"><i class="fab fa-youtube"></i> Hulpvideo</button>
                </h5>
            </div>
            <div id="collapseReservation" class="collapse" aria-labelledby="headingReservation" data-parent="#accordion">
                <div class="card-body">
                    <h6>Hoe maak ik een reservatie aan?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/reservations">Reservaties</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Nieuwe Reservatie Aanmaken"</span>.</li>
                        <li>Vul de achternaam, voornaam, e-mailadres, telefoonnummer, adres, gemeente en postcode in en
                            selecteer een voorstelling. Duid ook aan of de reservatie al betaald is.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>De nieuwe reservatie is nu zichtbaar op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe bewerk ik een bestaande reservatie?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/reservations">Reservaties</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Reservatie Bewerken"</span>.</li>
                        <li>Pas de gewenste gegevens aan door de inhoud van de velden te veranderen.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>De gewijzigde reservatie is nu zichtbaar op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe bewerk ik de gereserveerde tickets van een bestaande reservatie?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/reservations">Reservaties</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Reservatie Bewerken"</span>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Tickets Bewerken"</span>.</li>
                        <li>Pas de gereserveerde tickets aan door stoelen aan of af te vinken.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>Druk nogmaals op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>De reservatie is nu gewijzigd te zien op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe verwijder ik een bestaande reservatie?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/reservations">Reservaties</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Reservatie Verwijderen"</span>.</li>
                        <li>Bevestig de actie door in het pop-up venster op de knop <span
                                class="font-weight-bold">"OK"</span> te klikken.</li>
                        <li>De reservatie is nu verdwenen uit de overzichtspagina.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingHall">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseHall"
                        aria-expanded="false" aria-controls="collapseHall">
                        <i class="fas fa-warehouse"></i> Vragen over zalen
                    </button>
                    <button type="button" data-toggle="modal" data-target=".modalHall"
                        class="btn btn-outline-primary float-right"><i class="fab fa-youtube"></i> Hulpvideo</button>
                </h5>
            </div>
            <div id="collapseHall" class="collapse" aria-labelledby="headingHall" data-parent="#accordion">
                <div class="card-body">
                    <div class="card-body">
                        <h6>Hoe maak ik een zaal aan?</h6>
                        <ol>
                            <li>Navigeer naar <a href="/admin/halls">Zalen</a>.</li>
                            <li>Klik op de knop <span class="font-weight-bold">"Nieuwe Zaal Aanmaken"</span>.</li>
                            <li>Vul de naam, capacitiet, adres, plaats en postcode in en selecteer een voorstelling.</li>
                            <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                            <li>De nieuwe zaal is nu zichtbaar op de overzichtspagina.</li>
                        </ol>
                        <h6>Hoe bewerk ik een bestaande zaal?</h6>
                        <ol>
                            <li>Navigeer naar <a href="/admin/halls">Zalen</a>.</li>
                            <li>Klik op de knop <span class="font-weight-bold">"Zaal Bewerken"</span>.</li>
                            <li>Pas de gewenste gegevens aan door de inhoud van de velden te veranderen.</li>
                            <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                            <li>De zaal is nu gewijzigd te zien op de overzichtspagina.</li>
                        </ol>
                        <h6>Hoe verwijder ik een bestaande zaal?</h6>
                        <ol>
                            <li>Navigeer naar <a href="/admin/halls">Zalen</a>.</li>
                            <li>Klik op de knop <span class="font-weight-bold">"Zaal Verwijderen"</span>.</li>
                            <li>Bevestig de actie door in het pop-up venster op de knop <span
                                    class="font-weight-bold">"OK"</span> te klikken.</li>
                            <li>De zaal is nu verdwenen uit de overzichtspagina.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingUser">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseUser"
                        aria-expanded="false" aria-controls="collapseUser">
                        <i class="fas fa-users"></i> Vragen over medewerkers
                    </button>
                    <button type="button" data-toggle="modal" data-target=".modalUser"
                        class="btn btn-outline-primary float-right"><i class="fab fa-youtube"></i> Hulpvideo</button>
                </h5>
            </div>
            <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordion">
                <div class="card-body">
                    <h6>Hoe maak ik een medewerker aan?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/users">Medewerkers</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Nieuwe Medewerker Aanmaken"</span>.</li>
                        <li>Vul de voornaam, achternaam, e-mailadres, telefoonnummer, adres, plaats, postcode en wachtwoord
                            in en selecteer het geslacht. Duid ook aan of de medewerker actief is en of hij/zij een
                            administrator is.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>De nieuwe medewerker is nu zichtbaar op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe bewerk ik een bestaande medewerker?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/users">Medewerkers</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Medewerker Bewerken"</span>.</li>
                        <li>Pas de gewenste gegevens aan door de inhoud van de velden te veranderen.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>De medewerker is nu gewijzigd te zien op de overzichtspagina.</li>
                    </ol>
                    <h6>Hoe verwijder ik een bestaande medewerker?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/admin/users">Medewerkers</a>.</li>
                        <li>Klik op de knop <span class="font-weight-bold">"Medewerker Verwijderen"</span>.</li>
                        <li>Bevestig de actie door in het pop-up venster op de knop <span
                                class="font-weight-bold">"OK"</span> te klikken.</li>
                        <li>De medewerker is nu verdwenen uit de overzichtspagina.</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingProfile">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseProfile"
                        aria-expanded="false" aria-controls="collapseUser">
                        <i class="fas fa-user-cog"></i> Vragen over uw profiel
                    </button>
                    <button type="button" data-toggle="modal" data-target=".modalProfile"
                        class="btn btn-outline-primary float-right"><i class="fab fa-youtube"></i> Hulpvideo</button>
                </h5>
            </div>
            <div id="collapseProfile" class="collapse" aria-labelledby="headingProfile" data-parent="#accordion">
                <div class="card-body">
                    <h6>Hoe bewerk ik mijn profiel?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/user/profile">Profiel Updaten</a>.</li>
                        <li>Pas de gewenste gegevens aan door de inhoud van de velden te veranderen.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>Uw profiel is nu gewijzigd te zien.</li>
                    </ol>
                    <h6>Hoe wijzig ik mijn wachtwoord?</h6>
                    <ol>
                        <li>Navigeer naar <a href="/user/password">Wachtwoord Wijzigen</a>.</li>
                        <li>Vul uw huidig wachtwoord en nieuw wachtwoord in.</li>
                        <li>Druk op de knop <span class="font-weight-bold">"Opslaan"</span>.</li>
                        <li>Uw wachtwoord werd gewijzigd en u werd uitgelogd. U kan vanaf nu inloggen met uw nieuwe
                            wachtwoord.</li>
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
                        <iframe width="100%" height="600"
                            src="https://www.youtube.com/embed/4271nTM9kcw?list=PL5DZvsFexpNYOLIQMcTeUA4FI1afoDmFy"
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
    <div class="modal fade modalUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hulpvideo Medewerkers Beheren</h5>
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
    <div class="modal fade modalProfile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hulpvideo Profiel Beheren</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <iframe width="100%" height="600"
                            src="https://www.youtube.com/embed/af8ENMmXA-Y?list=PL5DZvsFexpNYOLIQMcTeUA4FI1afoDmFy"
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
