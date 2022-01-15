
@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_container" >

        @include('includes.errors')

        <div class="secondary_container">



            <h2 class="text-start mb-md-3">Подборки книг</h2>

            <table class="table table-bordered table-dark" style="width: max-content">

    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Author</th>
        <th scope="col">Genre</th>
{{--        <th scope="col">Books</th>--}}
        <th scope="col">Sort by price</th>
        <th scope="col">Sort by sales</th>
        <th scope="col">Limit</th>
        <th scope="col">Price parameter low</th>
        <th scope="col">Price parameter high</th>
        <th scope="col">Created date</th>
        <th scope="col">Operations</th>


    </tr>
    </thead>
    <tbody >
    @foreach($selections as $selection)
        <tr>

            <td>{{$selection->id}}</td>
            <td>{{$selection->selection_name}}</td>
            <td>
                @foreach($selection->authors as $author)
                {{$author->fullname}} <br>
                @endforeach
            </td>
            <td>
                @foreach($selection->genres as $genre)
                    {{$genre->genre_name}} <br>
                @endforeach
            </td>
{{--            <td>--}}
{{--                @foreach($selection->books as $book)--}}
{{--                    {{$book->book_name}} <br>--}}
{{--                @endforeach--}}
{{--            </td>--}}
            <td>{{$selection->sortByPrice}}</td>
            <td>{{$selection->sortBySales}}</td>
            <td>{{$selection->limit}}</td>
            <td>{{$selection->priceParamLow}}</td>
            <td>{{$selection->priceParamHigh}}</td>
            <td>{{$selection->created_at}}</td>
            <td>
                <a href="{{route('admin.selection.edit', $selection)}}"><button class="btn btn-primary">Edit</button></a>
                <a href="{{route('admin.selection.destroy', $selection)}}"><button class="btn btn-danger">Delete</button></a>

            </td>

        </tr>
    @endforeach

    </tbody>

</table>
        </div>
    </div>

@endsection
