@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')

<form action="{{route('admin.authorCreateSubmit')}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="" placeholder="Введите имя автора" id = "name" class="form-control">
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="surname" value="" placeholder="Введите фамилию автора" id = "surname" class="form-control">
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="birthday" value="" placeholder="Введите дату рождения автора" id = "birthday" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Add author</button>

</form>
</body>
</html>
