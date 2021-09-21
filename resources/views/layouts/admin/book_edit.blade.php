@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')


<form action="{{route('admin.bookEditSubmit', $book)}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="{{$book->name}}" placeholder="Введите имя" id = "name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="num_pages" value="{{$book->num_pages}}" placeholder="Введите имя" id = "ыгкname" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="created_date" value="{{$book->created_date}}" placeholder="Введите имя" id = "birthday" class="form-control">
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="author_id" value="{{$book->author->id}}" placeholder="Введите имя" id = "birthday" class="form-control">
    </div>



    <button type="submit" class="btn btn-success">Edit book</button>


</form>
</body>
</html>
