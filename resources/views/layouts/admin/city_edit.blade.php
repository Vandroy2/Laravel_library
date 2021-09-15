@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')


<form action="{{route('admin.cityEditSubmit', $city )}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="{{$city->name}}" placeholder="Введите имя" id = "name" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Edit city</button>


</form>
</body>
</html>
