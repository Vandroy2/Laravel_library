@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_container" style="">

        @include('includes.errors')

        <div class="secondary_container">

<h2>Жанры</h2>

<table class="table table-bordered table-dark">

    <thead>
    <tr align="center">
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Images</th>
        <th scope="col">Operations</th>


    </tr>
    </thead>
    <tbody >
    @foreach($genres as $genre)
        <tr align="center">

            <td>{{$genre->id}}</td>
            <td>{{$genre->genre_name}}</td>
            @if($genre->image)
            <td>
                <img class="img-fluid img_list_admin" src="{{asset('/storage/'. $genre->image->images)}}" alt="no image"/>
            </td>
            @else
                <td>
                    <img class="img-fluid img_list_admin" src = "/assets/img/empty.png" alt="no image"/>
                </td>
            @endif



            <td align="center">
                <div class = "flex">
                    <a href="{{route('admin.genres.edit', $genre->id)}}"><button class="btn btn-primary">Edit</button></a>




                    <form method="POST" action="{{route('admin.genres.destroy', $genre->id)}}">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class = "btn btn-danger" title="Delete Post">Delete</button>
                    </form>
                </div>



            </td>

        </tr>
    @endforeach

    </tbody>

</table>
        </div>
    </div>


@endsection
