<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
            <script type="text/javascript"
            src="{{env('URL_MIDTRANS')}}"
            data-client-key="{{env('CLIENT_KEY')}}"></script>
            <title>Topup Games Termurah dan Aman | WAWTOPUP</title>
            <link rel="icon" href="{{ asset('storage/static/assets/logo.webp') }}" type="image/x-icon">
        </head>
    <body>
        <div class="area" >
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
            <div class="content">
                <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
                    <div class="container-fluid">
                        <a class="navbar-brand text-light-emphasis fs-4 fw-bold" href="#">WAWTOPUP</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="mx-auto navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item rounded">
                                    <a class="d-flex nav-link fs-5 text-light-emphasis rounded fw-bold" aria-current="page" href="/"><span class="material-symbols-outlined">home</span>Beranda</a>
                                </li>
                                <li class="nav-item rounded">
                                    <a class="d-flex nav-link fs-5 text-light-emphasis rounded fw-bold" href="/cek-transaksi">Cek Transaksi<span class="material-symbols-outlined">search</span></a>
                                </li>
                                <div class=" search-container d-flex" role="search">
                                    <input class="nav-link border border-light-emphasis rounded fw-bold" style="width: 100%;" type="text" id="searchInput" placeholder="Cari Produk...">
                                    <div id="searchResults" class=" nav-link rounded search-results d-none"></div>
                                </div>
                            </ul>
                            <ul class="navbar-nav me-2">
                                @guest
                                    <li class="nav-item rounded">
                                        <a class="d-flex nav-link fs-5 text-light-emphasis rounded fw-bold" aria-current="page" href="{{ route('login')}}"><span class="material-symbols-outlined">login</span>Login</a>
                                    </li>
                                @endguest
                                @auth
                                    <li class="nav-item rounded">
                                        <a class="d-flex nav-link fs-5 text-light-emphasis rounded fw-bold" aria-current="page" href="{{ route('dashboard')}}"><span class="material-symbols-outlined">Dashboard</span>Dashboard</a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
                <div style="margin-top: 5rem;">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="{{ asset('js/main.js')}}"></script>
        <script src="{{ asset('js/livesearch.js')}}"></script>
        <script>
            let currentIndex = 0;

            function showSlide(index) {
            const slider = document.querySelector('.slider');
            const slides = document.querySelectorAll('.slide');
            if (index >= slides.length) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = slides.length - 1;
            } else {
                currentIndex = index;
            }
            slider.style.transform = `translateX(${-currentIndex * 100}%)`;
            }
            function prevSlide() {
            showSlide(currentIndex - 1);
            }
            function nextSlide() {
            showSlide(currentIndex + 1);
            }
            setInterval(nextSlide, 5000);
        </script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                var contentHeight = $('.content').outerHeight();
                $('.circles').css('height', contentHeight + 'px');
            });
        </script>
    </body>
</html>