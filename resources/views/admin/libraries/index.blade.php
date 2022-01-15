
@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_container" style="">

        @include('includes.errors')

        <div class="secondary_container">

            <h2>Библиотеки</h2>

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

</div>
</div>

@endsection

