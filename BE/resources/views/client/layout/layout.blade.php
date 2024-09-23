<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous">
    <title>@yield('title')</title>
    @yield('style')
    @yield('script-special')
</head>
<body>

    {{-- menu --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">News</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <div class="d-flex">
                    <a href="{{route('login')}}" class="btn btn-outline-success me-2" type="button">Login</a>
                    <button class="btn btn-primary" type="button">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>

                    @foreach ($categories as $cate)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.detail', $cate->slug) }}">{{ $cate->name }}</a>
                    </li>
                    @endforeach
                   <li class="nav-item">
                        <a class="nav-link" href="{{route('profile')}}">Profile</a>
                    </li>
                  
                </ul>
               
            </div>
        </div>
    </nav>

    {{-- Slider --}}
    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="https://th.bing.com/th/id/OIP.PrJY-eorLheSUAPSuMEqJAHaCj?rs=1&pid=ImgDetMain" class="d-block w-100" alt="https://th.bing.com/th/id/OIP.PrJY-eorLheSUAPSuMEqJAHaCj?rs=1&pid=ImgDetMain">
          </div>
          <div class="carousel-item" data-bs-interval="2000">
            <img src="https://media.istockphoto.com/id/996167170/vector/artificial-intelligence-concept-technology-background-vector-science-illustration.jpg?s=170667a&w=0&k=20&c=JiaY1fvLiQIsU7E26UnCt_QMMlrVj9TxxRkpJ3tSXko=" class="d-block w-100" alt="https://media.istockphoto.com/id/996167170/vector/artificial-intelligence-concept-technology-background-vector-science-illustration.jpg?s=170667a&w=0&k=20&c=JiaY1fvLiQIsU7E26UnCt_QMMlrVj9TxxRkpJ3tSXko=">
          </div>
        
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    {{-- Nội dung chính --}}
    <div class="container">
       @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="container-fluid text-center bg-light">
       <h4> Footer</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @yield('script-lib')
    @yield('script')

</body>
</html>
