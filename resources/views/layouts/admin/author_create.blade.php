@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')

<form action="{{route('admin.authorStore')}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="author_name"></label>
        <input type="text" name="author_name" value="" placeholder="Введите имя автора" id = "author_name" class="form-control">
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="author_surname" value="" placeholder="Введите фамилию автора" id = "author_surname" class="form-control">
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="birthday" value="" placeholder="Введите дату рождения автора" id = "birthday" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Add author</button>

</form>
</body>
</html>
