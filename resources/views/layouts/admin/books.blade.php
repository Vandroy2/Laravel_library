@include('includes.head')
<body style="background-image: url(https://www.peopleg2.com/wp-content/uploads/2014/02/Depositphotos_18398501_xl-2015-scaled-1-2048x1536.jpg)">
@include('includes.navbar')

@include('includes.scripts')
@include('includes.errors')

<table class="table table-bordered table-dark">

    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Number of page</th>
        <th scope="col">Created date</th>
        <th scope="col">Author name</th>
        <th scope="col">Author surname</th>
        <th scope="col">Library name</th>
        <th scope="col">Operations</th>


    </tr>
    </thead>
    <tbody >
    @foreach($books as $book)
        <tr>

            <td>{{$book->id}}</td>
            <td>{{$book->book_name}}</td>
            <td>{{$book->num_pages}}</td>
            <td>{{$book->created_date}}</td>
            <td>{{$book->author->author_name}}</td>
            <td>{{$book->author->author_surname}}</td>
            <td>{{$book->library->library_name}}</td>



            <td>
                <a href="{{route('admin.bookEdit', $book)}}"><button class="btn btn-primary">Edit</button></a>
                <a href="{{route('admin.bookDelete', $book)}}"><button class="btn btn-danger">Delete</button></a>

            </td>

        </tr>
    @endforeach

    </tbody>

</table>

<div style="display: flex; flex-direction: column; width: 25%;">
    <form action="{{ route('admin.books') }}" method="get">
        <label>
            <input name="search_book" placeholder="Search" type="search">
        </label>
        <button type="submit" style="width: 25%">Search</button>
    </form>
</div>
{{$books->links()}}


</body>
</html>
