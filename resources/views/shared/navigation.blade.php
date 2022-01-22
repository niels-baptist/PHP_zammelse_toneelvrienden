<nav class="navbar navbar-dark navbar-expand-md shadow-sm mb-4">
    <div class="container">
        <img src="/icons/Zammelse_Toneelvrienden_White.png" alt="Logo" style="width: 5%; margin-right: 2%">
        <a class="navbar-brand" href="/"> Zammelse Toneelvrienden</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav ml-auto">
                @guest

                    <li class="nav-item">
                        <a class="nav-link" href="/help"><i class="fas fa-question"></i> Help</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i> Login</a>
                    </li>
                @endguest
                @auth
                    @if (auth()->user()->admin)
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/home"><i class="fas fa-user-cog"></i> Dashboard</a>
                        </li>
                    @endif
                    @if (auth()->user()->admin)
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/help"><i class="fas fa-question fa-fw"></i> Help</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/user/help"><i class="fas fa-question fa-fw"></i> Help</a>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                            {{ auth()->user()->firstName }} {{ auth()->user()->surname }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/user/profile"><i class="fas fa-user-cog fa-fw"></i> Profiel
                                updaten</a>
                            <a class="dropdown-item" href="/user/password"><i class="fas fa-key fa-fw"></i> Wachtwoord
                                wijzigen</a>
                            @if (auth()->user()->admin)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/play"><i class="fas fa-microphone-alt fa-fw"></i>
                                    Toneelstukken</a>
                                <a class="dropdown-item" href="/admin/performances"><i
                                        class="fas fa-person-booth fa-fw"></i>
                                    Voorstellingen</a>
                                <a class="dropdown-item" href="/admin/reservations"><i
                                        class="fas fa-clipboard-check fa-fw"></i> Reservaties</a>
                                <a class="dropdown-item" href="/admin/halls"><i class="fas fa-warehouse fa-fw"></i>
                                    Zalen</a>
                                <a class="dropdown-item" href="/admin/users"><i class="fas fa-users fa-fw"></i>
                                    Medewerkers</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
