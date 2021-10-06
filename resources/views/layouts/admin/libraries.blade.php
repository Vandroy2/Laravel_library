@include('includes.admin.head')
<body style="background-image: url(https://www.peopleg2.com/wp-content/uploads/2014/02/Depositphotos_18398501_xl-2015-scaled-1-2048x1536.jpg)">
@include('includes.admin.navbar')

@include('includes.admin.scripts')
@include('includes.errors')
<table class="table table-bordered table-dark">

    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">City</th>

        <th scope="col">Operations</th>


    </tr>
    </thead>
    <tbody >
    @foreach($libraries as $library)
        <tr>

            <td>{{$library->id}}</td>
            <td>{{$library->library_name}}</td>
            <td>{{$library->city->city_name}}</td>

            <td>
               <a href="{{route('admin.libraryEdit', $library)}}"><button class="btn btn-primary">Edit</button></a>
              <a href="{{route('admin.libraryDelete', $library)}}"><button class="btn btn-danger">Delete</button></a>

            </td>


        </tr>
    @endforeach

    </tbody>

</table>





<div style="display: flex; flex-direction: column; width: 25%;">
    <form action="{{ route('admin.libraries') }}" method="get">
        <label>
            <input name="search_library" placeholder="Search" type="search">
        </label>
        <button type="submit">Search</button>
    </form>
</div>

{{$libraries->links()}}

</body>

