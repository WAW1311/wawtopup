<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <title>Dashboard | WAWTOPUP</title>
            <link rel="icon" href="{{ asset('storage/static/assets/logo.webp') }}" type="image/x-icon">
        </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar -->
            <nav id="sidebar" class="sidebar bg-light shadow" style="z-index:1;">
                <div class="sidebar-header mt-3">
                    <h3 class="text-center fw-bold text-light-emphasis">Dashboard</h3>
                </div>
                <ul class="list-unstyled components">
                    <li>
                        <a href="{{ route('dashboard') }}" aria-expanded="false" class="text-light-emphasis fw-bold">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('product') }}"  aria-expanded="false" class="text-light-emphasis fw-bold">Product</a>
                    </li>
                    <li>
                        <a href="{{ route('cart_user') }}"  aria-expanded="false" class="text-light-emphasis fw-bold">History pembelian</a>
                    </li>
                    <li>
                        <a href="{{ route('history') }}"  aria-expanded="false" class="text-light-emphasis fw-bold">History pengiriman</a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex nav-link text-light-emphasis rounded fw-bold" aria-current="page" href="/"><span class="material-symbols-outlined">logout</span>Beranda</a>
                    </li>
                    <li>
                        <a class="d-flex text-light-emphasis rounded fw-bold" aria-current="page" href="{{ route('logout')}}"><span class="material-symbols-outlined">logout</span>logout</a>
                    </li>
                </ul>
            </nav>
            <!-- Page Content -->
            <div id="content">
                <nav class="shadow-bottom navbar navbar-expand-lg navbar-light bg-light" style="height: 54px;">
                    <div class="container-fluid">
                        <button type="button" id="sidebarCollapse" class="nav-toggle btn btn-primary">
                            <i class="fas fa-align-left"></i>
                            <span>Menu</span>
                        </button>
                    </div>
                </nav>
                @yield('content')
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/main.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
    </body>
</html>