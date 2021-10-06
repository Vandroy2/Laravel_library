@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')


<form action="{{route('admin.cityUpdate', $city )}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="city_name" value="{{$city->city_name}}" placeholder="Введите имя" id = "name" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Edit city</button>


</form>
</body>
</html>
