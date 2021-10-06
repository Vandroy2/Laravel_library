@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')


<form action="{{route('admin.authorUpdate', $author)}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="author_name" value="{{$author->author_name}}" placeholder="Введите имя" id = "author_name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="author_surname" value="{{$author->author_surname}}" placeholder="Введите имя" id = "author_surname" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="birthday" value="{{$author->birthday}}" placeholder="Введите имя" id = "birthday" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Edit author</button>


</form>
</body>
</html>
