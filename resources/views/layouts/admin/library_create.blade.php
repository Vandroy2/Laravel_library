@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')

<form action="{{route('admin.libraryCreateSubmit')}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="" placeholder="Введите название библиотеки" id = "name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="city_id" value="" placeholder="Введите id города" id = "city_id" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Add Library</button>

</form>
</body>
</html>
