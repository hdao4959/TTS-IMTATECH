<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        crossorigin="anonymous">
    <title>@yield('title')</title>
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet"> --}}
    <style>
        body {
            position: relative;
            /* font-family: "Open Sans", sans-serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal; */
            /* font-variation-settings:
                "wdth" 100; */
        }

        .button-scroll-up {
            border: 1px gray solid;
            bottom: 50px;
            right: 2%;
            position: fixed;
            border-radius: 50%
        }
    </style>
    @yield('style')
    @yield('script-special')
</head>

<body class="bg-light">

    {{-- menu --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">News</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">

                </ul>

                @if (Auth::user())
                    <div class="">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </div>
                    <div>
                        <a class="btn btn-outline-danger" href="{{ route('logout') }}">Logout</a>
                    </div>
                @else
                    <div class="d-flex">
                        <a href="{{ route('login') }}" class="btn btn-outline-success me-2" type="button">Sign in</a>
                        <a href="{{ route('register') }}" class="btn btn-primary" type="button">Sign Up</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>

                    @foreach ($categories as $cate)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('category.detail', $cate->slug) }}">{{ $cate->name }}</a>
                        </li>
                    @endforeach


                </ul>
                <ul>
                    <form class="d-flex" role="search" action="{{ route('search') }}">
                        <input class="form-control me-2" name="keyword" type="search" placeholder="Search"
                            aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </ul>

            </div>
        </div>
    </nav>

    {{-- Slider --}}
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="https://th.bing.com/th/id/OIP.PrJY-eorLheSUAPSuMEqJAHaCj?rs=1&pid=ImgDetMain"
                    class="d-block w-100"
                    alt="https://th.bing.com/th/id/OIP.PrJY-eorLheSUAPSuMEqJAHaCj?rs=1&pid=ImgDetMain">
            </div>


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- Nội dung chính --}}
    <div class="container">
        @yield('content')
        <button class="button-scroll-up" id="buttonScrollUp"><i class="fa-solid fa-caret-up"></i></button>
    </div>

    {{-- Footer --}}
    <footer class="container-fluid text-center bg-light">
        <h4> Footer</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @yield('script-lib')

    <script>
        const buttonScrollUp = document.getElementById('buttonScrollUp')
        window.onscroll = function() {
            // Nếu người dùng cuộn xuống hơn 100px thì hiện nút, nếu không thì ẩn nút
            if (window.scrollY > 500) {
                buttonScrollUp.style.display = "block"; // Hiện nút
            } else {
                buttonScrollUp.style.display = "none"; // Ẩn nút
            }
        }

        buttonScrollUp.onclick = function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
        }
    </script>
    @yield('script')
</body>

</html>
