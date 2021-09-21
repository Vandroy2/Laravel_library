@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')


<form action="{{route('admin.authorEditSubmit', $author)}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="{{$author->name}}" placeholder="Введите имя" id = "name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="surname" value="{{$author->surname}}" placeholder="Введите имя" id = "ыгкname" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="birthday" value="{{$author->birthday}}" placeholder="Введите имя" id = "birthday" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Edit author</button>


</form>
</body>
</html>
