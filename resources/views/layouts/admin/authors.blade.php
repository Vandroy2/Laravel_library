<?php
/* @var \App\Models\Author[] $authors */
?>

@include('includes.admin.head')
<body style="background-image: url(https://www.peopleg2.com/wp-content/uploads/2014/02/Depositphotos_18398501_xl-2015-scaled-1-2048x1536.jpg)">
@include('includes.admin.navbar')

@include('includes.admin.scripts')
@include('includes.errors')

<table class="table table-bordered table-dark">

    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Birthday</th>
        <th scope="col">Deathday</th>
        <th scope="col">Age</th>
        <th scope="col">Operations</th>


    </tr>
    </thead>
    <tbody >
    @foreach($authors as $author)
        <tr>

            <td>{{$author->id}}</td>
            <td>{{$author->author_name}}</td>
            <td>{{$author->author_surname}}</td>
            <td>{{ $author->birthday ? $author->birthday->format('d/m/Y') : 'Undefined' }}</td>
            <td>{{ $author->death_day ? $author->death_day->format('d/m/Y') : 'Life' }}</td>
            <td>{{$author->age}}</td>


            <td>
                <a href="{{route('admin.authorEdit', $author)}}"><button class="btn btn-primary">Edit</button></a>
                <a href="{{route('admin.authorDelete', $author)}}"><button class="btn btn-danger">Delete</button></a>

            </td>

        </tr>
    @endforeach

    </tbody>

</table>



<div style="display: flex; flex-direction: column; width: 25%;">
    <form action="{{ route('admin.authors') }}" method="get">
        <label>
            <input name="search_author" placeholder="Search" type="search">
        </label>
        <button type="submit" style="width: 25%">Search</button>
    </form>
</div>

</body>
</html>
