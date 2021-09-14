<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">

    <title>Document</title>
</head>
<body style="background-image: url(https://www.peopleg2.com/wp-content/uploads/2014/02/Depositphotos_18398501_xl-2015-scaled-1-2048x1536.jpg)">
@include('includes.navbar')

@include('includes.scripts')
@include('includes.errors')
<table class="table table-bordered table-dark">

    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col">email</th>
        <th scope="col">birthday</th>
        <th scope="col">operations</th>

    </tr>
    </thead>
    <tbody >
    @foreach($users as $user)
        <tr>

            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->surname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->birthday}}</td>
            <td>
              <a href="{{route('admin.userEdit', $user)}}"><button class="btn btn-primary">Update</button></a>
               <a href="{{route('admin.userDelete', $user)}}"><button class="btn btn-danger">Delete</button></a>

            </td>

        </tr>
    @endforeach

    </tbody>
    <a href="{{route('admin.userCreate', $user)}}"><button class="btn btn-success" style="width: 100px">Create</button></a>
</table>

</body>
</html>
