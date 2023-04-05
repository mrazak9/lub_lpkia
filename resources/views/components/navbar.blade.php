<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown" id="myDropdown">
                    @if (Auth::user())
                        @if (Auth::user()->occupation == 'Mahasiswa')
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Input Calon Mahasiswa
                            </a>
                        @endif
                    @else
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Input Calon Mahasiswa
                        </a>
                    @endif
                    <ul class="dropdown-menu">
                        @if (Auth::user())
                            @if (Auth::user()->occupation == 'Mahasiswa')
                                <li>
                                    <a class="dropdown-item" href="{{ route('transaction.create.pmm') }}">
                                        PMM (Mahasiswa)
                                    </a>
                                </li>
                            @elseif (Auth::user()->occupation != 'Mahasiswa')
                                {{-- <a href="{{ route('home') }}" class="btn btn-master btn-primary w-100 mt-3">
                                    Input PMM
                                </a> --}}
                            @endif
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('transaction.create.pmm_guest') }}">
                                    PMM (Mahasiswa)
                                </a>
                            </li>
                        @endif

                        @if (Auth::user())
                            @if (Auth::user()->occupation == 'Alumni')
                                <li>
                                    <a class="dropdown-item" href="{{ route('transaction.create.ppa_user') }}">
                                        PPA (Alumni)
                                    </a>
                                </li>
                            @elseif (Auth::user()->occupation != 'Alumni')
                                {{-- <a href="{{ route('home') }}" class="btn btn-master btn-primary w-100 mt-3">
                                                Input PPA
                                            </a> --}}
                            @endif
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('transaction.create.ppa') }}">
                                    PPA (Alumni)
                                </a>
                            </li>
                        @endif

                        @if (Auth::user())
                            @if (Auth::user()->occupation == 'Guru')
                                <li>
                                    <a class="dropdown-item" href="{{ route('transaction.create.ppg') }}"> PPG (Guru)
                                    </a>
                                </li>
                            @elseif (Auth::user()->occupation != 'Guru')
                                {{-- <a href="{{ route('home') }}" class="btn btn-master btn-primary w-100 mt-3">
                                Input PPG
                            </a> --}}
                            @endif
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('transaction.create.ppg_guest') }}"> PPG
                                    (Guru) </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="blank" href="https://lpkia.ac.id/beasiswa-lpkia/">Program
                        Beasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="blank"
                        href="https://drive.google.com/file/d/1d4447Z6QKEdoNNSI75HJLrMxwplLcclm/view">Panduan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kontak</a>
                </li>

            </ul>
            @auth
                <div class="d-flex user-logged nav-item dropdown no-arrow">
                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Halo, {{ Auth::user()->name }}!
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" class="user-photo" alt=""
                                style="border-radius: 50%">
                        @else
                            <img src="https://ui-avatars.com/api?name=Admin" class="user-photo" alt=""
                                style="border-radius: 50%">
                        @endif
                        <ul class="dropdown-menu" aria-labelledby="drpodownMenuLink" style="right: 0; left:auto">
                            <li>
                                <a href="{{ route('dashboard') }}" class="dropdown-item">My Dashboard</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign
                                    Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post"
                                    style="display: none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </li>
                        </ul>
                    </a>
                </div>
            @else
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-master btn-secondary me-3">
                        Sign In
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
