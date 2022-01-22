@extends('layouts.template')
@section('main')
    <h1>Medewerkers Beheren</h1>
    @include('shared.alert')
    <p>
        <a href="/admin/users/create" class="btn btn-primary" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>Nieuwe Medewerker Aanmaken
        </a>
        <button data-toggle="tooltip" title="Kopieer alle mailadressen naar klembord" id="BtnCopyMail"
            class="btn btn-outline-primary float-right ml-1">
            <i class="fas fa-envelope-open-text mr-1"></i>Mailadressen kopiëren
        </button>
        <button type="button" data-toggle="modal" data-target=".modalUser" class="btn btn-outline-primary float-right">
            <i class="fab fa-youtube"></i> Hulpvideo
        </button>
    </p>

    <form method="get" action="/admin/users" id="searchForm">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="name" id="name" value="{{ request()->name }}"
                    placeholder="Filter op naam">
            </div>
            <div class="col-sm-5 mb-2">
                <select class="form-control" name="sort_by" id="sort_by">
                    <option value="name_asc" {{ request()->sort_by == 'name_asc' ? 'selected' : '' }}>Voornaam
                        (oplopend)
                    </option>
                    <option value="name_desc" {{ request()->sort_by == 'name_desc' ? 'selected' : '' }}>Voornaam
                        (aflopend)
                    </option>
                    <option value="lName_asc" {{ request()->sort_by == 'lName_asc' ? 'selected' : '' }}>Achternaam
                        (oplopend)
                    </option>
                    <option value="lName_desc" {{ request()->sort_by == 'lName_desc' ? 'selected' : '' }}>Achternaam
                        (aflopend)
                    </option>
                    <option value="place_asc" {{ request()->sort_by == 'place_asc' ? 'selected' : '' }}>Plaats
                        (oplopend)
                    </option>
                    <option value="place_desc" {{ request()->sort_by == 'place_desc' ? 'selected' : '' }}>Plaats
                        (aflopend)
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

    <div class="table-responsive w-100">
        <table class="table">
            <thead>
                <tr>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Email</th>
                    <th>Adres</th>
                    <th>Plaatsnaam</th>
                    <th>Telefoonnummer</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><a href="/admin/users/{{ $user->id }}">{{ $user->firstName }}</a></td>
                        <td><a href="/admin/users/{{ $user->id }}">{{ $user->surname }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->place }}</td>
                        <td><a href="tel:{{ $user->telephone }}">{{ $user->telephone }}</a></td>
                        <td>
                            <form action="/admin/users/{{ $user->id }}" method="post">
                                @method('delete')
                                @csrf
                                <div>
                                    <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-sm btn-outline-primary"
                                        data-toggle="tooltip" title="Medewerker Bewerken">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger deleteUser"
                                        data-toggle="tooltip" data-name="{{ $user->firstName }} {{ $user->surname }}"
                                        title="Medewerker Verwijderen">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <p style="display: none" id="PMailList">{{ $maillist }}</p>
        </div>
    </div>

    @if ($users->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Er kan geen medewerker gevonden worden met <b>'{{ request()->name }}'</b> als naam
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

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
                            src="https://www.youtube.com/embed/Rfztz8lcCRE?list=PL5DZvsFexpNYOLIQMcTeUA4FI1afoDmFy"
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
            $('.deleteUser').click(function() {
                let name = $(this).data('name');
                let msg = `Weet u zeker dat u gebruiker "${name}" wilt verwijderen? \nDeze actie kan niet ontdaan worden!`;
                if (confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })

            // submit form when leaving text field / dropdown lists
            $('#name').blur(function() {
                $('#searchForm').submit();
            });
            $('#name, #sort_by').change(function() {
                $('#searchForm').submit();
            });
        });

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
    </script>
@endsection
