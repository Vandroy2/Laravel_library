@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')


<form action="{{route('admin.libraryEditSubmit', $library )}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="{{$library->name}}" placeholder="Введите имя" id = "name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="city_id" value="{{$library->city_id}}" placeholder="Введите имя" id = "city_id" class="form-control">
    </div>

{{--    <div class="btn-group">--}}
{{--        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--            Action--}}
{{--        </button>--}}
{{--        <div class="dropdown-menu">--}}
{{--            @foreach($libraries as $library)--}}
{{--            <a class="dropdown-item" href="#">{{$library->city->name}}</a>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}

    <button type="submit" class="btn btn-success">Edit library</button>


</form>
</body>
</html>
