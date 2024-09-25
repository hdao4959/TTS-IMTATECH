<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<body>
<div class="container w-50">
    {{-- @if ($errors->any())
        <div class="text-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    
    @if(session('msg'))
        <div class="alert alert-success">{{session('msg')}}</div>
    @endif

    @if(session('errorLogin'))
        <div class="alert alert-danger">{{session('errorLogin')}}</div>
    @endif
    <h1 class="h1">Login</h1>
    <form action="{{route('login')}}" method="post">
        @csrf

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" >
            @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" >
            @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
        </div>
        <div>
            <input type="checkbox" name="remember_token"> Nhớ đăng nhập
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Login </button>
        </div>
        <div class="mb-3">
            <a href="{{route('register')}}" type="submit" class="btn btn-primary">Register </a>
        </div>

    </form>
</div>
</body>

</html>
