@include('includes.head')
<body style="background-image: url(https://www.peopleg2.com/wp-content/uploads/2014/02/Depositphotos_18398501_xl-2015-scaled-1-2048x1536.jpg)">
@include('includes.navbar')

@include('includes.scripts')
@include('includes.errors')

<table class="table table-bordered table-dark" style="width: max-content">

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
            <td>{{$city->city_name}}</td>
            <td>
              <a href="{{route('admin.cityEdit', $city)}}"><button class="btn btn-primary">Edit</button></a>
              <a href="{{route('admin.cityDelete', $city)}}"><button class="btn btn-danger">Delete</button></a>

            </td>

        </tr>
    @endforeach

    </tbody>

</table>
<div style="display: flex; flex-direction: column; width: 25%;">
    <form action="{{ route('admin.cities') }}" method="get">
        <label>
            <input name="search_name" placeholder="Search name" type="search">
        </label>
        <button type="submit">Search</button>
    </form>
    </div>
</body>
</html>
