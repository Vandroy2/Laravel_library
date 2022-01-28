

@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_container" >

        @include('includes.errors')

        <div class="secondary_container">

            <h2>Подписки</h2>

            <table class="table table-bordered table-dark">

                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Operations</th>


                </tr>
                </thead>
                <tbody >
                @foreach($subscribes as $subscribe)

                    <tr>

                        <td>{{$subscribe->id}}</td>
                        <td>{{$subscribe->subscribe_type}}</td>
                        <td>{{$subscribe->subscribe_price}}</td>
                        <td>{{$subscribe->duration}}</td>

                        <td>
                            <a href="{{route('admin.subscribe.edit', $subscribe)}}"><button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('admin.subscribe.destroy', $subscribe)}}"><button class="btn btn-danger">Delete</button></a>

                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>
    </div>

@endsection
