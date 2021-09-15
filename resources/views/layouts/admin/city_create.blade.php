@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')

<form action="{{route('admin.cityCreateSubmit')}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="" placeholder="Введите название города" id = "name" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Add city</button>

</form>
</body>
</html>
