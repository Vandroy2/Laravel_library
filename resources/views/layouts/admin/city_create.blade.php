@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')

<form action="{{route('admin.cityStore')}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="city_name" value="" placeholder="Введите название города" id = "name" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Add city</button>

</form>
</body>
</html>
