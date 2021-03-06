@extends('layouts.admin.adminMain')


@section('content')

    <div class="admin_container">

        @include('includes.errors')

        <div class="secondary_container">

            <h2>Города</h2>

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
            {{$cities->links()}}

        </div>
    </div>


@endsection
