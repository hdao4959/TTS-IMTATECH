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

    <h1 class="h1">Register</h1>
    <form action="{{route('subregister')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row" style="margin-bottom: 30px">
        <div class="col-md-6">
                    <label>Name:</label>
                    <input type="text" name="name" class="form-control" >
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
        </div>
        <div class="col-md-6">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" >
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="col-md-6">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" >
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <label>Description:</label>
            <input type="text" name="description" class="form-control" >
            @error('description')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <label>Avatar:</label>
            <input type="file" name="avatar" class="form-control"  id="file_img">
            <img src="" id="img"  width="100px" height="100px">
            @error('avatar')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="col-md-6">
            <input type="hidden" name="role_id" value="1">
        </div>
    </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Register </button>
        </div>
        <div class="mb-3">
            <a href="{{route('login')}}" type="submit" class="btn btn-primary">Login </a>
        </div>

    </form>
</div>
<script>
    var fileimg=document.querySelector('#file_img');
    var img=document.querySelector('#img');

    fileimg.addEventListener('change',function(e){
        e.preventDefault()
        img.src=URL.createObjectURL(this.files[0])
    })
</script>
</body>

</html>
