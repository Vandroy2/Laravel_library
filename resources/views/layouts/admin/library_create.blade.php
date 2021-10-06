@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')

<form action="{{route('admin.libraryStore')}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="library_name"></label>
        <input type="text" name="library_name" value="" placeholder="Введите название библиотеки" id = "library_name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="city_id" value="" placeholder="Введите id города" id = "city_id" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Add Library</button>

</form>
</body>
</html>
