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
        <th scope="col">Surname</th>
        <th scope="col">email</th>
        <th scope="col">birthday</th>
        <th scope="col">banned</th>
        <th scope="col">Images</th>
        <th scope="col">operations</th>


    </tr>
    </thead>
    <tbody >
    @foreach($users as $user)
        <tr>

            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->surname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->birthday}}</td>
            <td>{{$user->banned}}</td>
            <td>
                @foreach($user->images as $image)
                    <img class="img-fluid" src="{{asset('/storage/'. $image->images)}}" width="150" height="200" />
                @endforeach
            </td>
            <td>
              <a href="{{route('admin.userEdit', $user)}}"><button class="btn btn-primary">Edit</button></a>
                @can('admin.delete')
               <a href="{{route('admin.userDelete', $user)}}"><button class="btn btn-danger">Delete</button></a>
                @endcan
            </td>


        </tr>
    @endforeach

    </tbody>

</table>


    </form>


</div>



<div style="display: flex; flex-direction: column; width: 25%;">
    <form action="{{ route('admin.users') }}" method="get">
        <label>
            <input name="search_user" placeholder="Search " type="search">
        </label>
        <button type="submit" style="width: 25%">Search</button>
    </form>
</div>

</body>
{{--<td><a href="{{route('admin.userCreate', $user)}}"><button class="btn btn-success" style="width: 200px; ">Create</button></a></td>--}}
</html>
