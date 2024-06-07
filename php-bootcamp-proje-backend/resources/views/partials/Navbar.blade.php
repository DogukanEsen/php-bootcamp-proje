<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="navbar-brand" href={{ url('books') }}>Bookstore</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#basic-navbar-nav"
                    aria-controls="basic-navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-6">
                <form class="d-flex" action="{{ route('books.search') }}" method="GET">
                    <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
            <div class="col">
                <div class="collapse navbar-collapse" id="basic-navbar-nav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Kayıt Ol</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Giriş Yap</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('account.settings') }}">Hesap Ayarları</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                    Çıkış Yap
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#basic-navbar-nav"
            aria-controls="basic-navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="basic-navbar-nav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', 'Cok_satanlar') }}">Çok satanlar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', 'Macera') }}">Macera</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', 'Korku') }}">Korku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', 'Ask') }}">Aşk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', 'Tarih') }}">Tarih</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', 'Fantastik') }}">Fantastik</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', 'Bilim_kurgu') }}">Bilim kurgu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.show', 'Cinayet') }}">Cinayet</a>
                </li>
                @auth
                    @if (!Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.view') }}">Sepete Git</a>
                        </li>
                    @elseif (Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('books.create') }}">Kitap Ekle</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
