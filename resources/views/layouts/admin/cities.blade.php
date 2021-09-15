@include('includes.head')
<body style="background-image: url(https://www.peopleg2.com/wp-content/uploads/2014/02/Depositphotos_18398501_xl-2015-scaled-1-2048x1536.jpg)">
@include('includes.navbar')

@include('includes.scripts')
@include('includes.errors')
{{--<a href="{{route('admin.cityCreate', $city}}"><button class="btn btn-success" style="width: 300px">Create</button></a>--}}
<table class="table table-bordered table-dark">

    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Operations</th>


    </tr>
    </thead>
    <tbody >
    @foreach($cities as $city)
        <tr>

            <td>{{$city->id}}</td>
            <td>{{$city->name}}</td>

            <td>
              <a href="{{route('admin.cityEdit', $city)}}"><button class="btn btn-primary">Update</button></a>
              <a href="{{route('admin.cityDelete', $city)}}"><button class="btn btn-danger">Delete</button></a>

            </td>

        </tr>
    @endforeach

    </tbody>

</table>

</body>
</html>
