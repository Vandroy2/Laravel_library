@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')


<form action="{{route('admin.libraryUpdate', $library )}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="library_name" value="{{$library->library_name}}" placeholder="Введите имя" id = "name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="city_id" value="{{$library->city_id}}" placeholder="Введите имя" id = "city_id" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Edit library</button>


</form>
</body>
</html>
