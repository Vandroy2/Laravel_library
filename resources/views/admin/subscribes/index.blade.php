

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
                @foreach($listOfSubscribes as $listOfSubscribe)

                    <tr>

                        <td>{{$listOfSubscribe->id}}</td>
                        <td>{{$listOfSubscribe->listOfSubscribeType}}</td>
                        <td>{{$listOfSubscribe->listOfSubscribePrice}}</td>
                        <td>{{$listOfSubscribe->duration}}</td>

                        <td>
                            <a href="{{route('admin.listOfSubscribe.edit', $listOfSubscribe)}}"><button class="btn btn-primary">Edit</button></a>
                            <a href="{{route('admin.listOfSubscribe.destroy', $listOfSubscribe)}}"><button class="btn btn-danger">Delete</button></a>

                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>

        </div>
    </div>

@endsection
