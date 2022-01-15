@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_orders_container">

        @include('includes.errors')

        <div class="secondary_container">


<div class="row">
    <div class="col-lg-12">
        <div class="page-header orders_title_container">
            <h2 class="genre_text">Заказы</h2>
        </div>

        <div class="bs-component">
            <table class="table table-hover">

                <thead>
                <tr>
                    <th scope="col">Order number</th>
                    <th scope="col">User name</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Status</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Operations</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="table-active">
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->status->status}}</td>
                        <td>{{$order->order_comment}}</td>
                        <td class="flex">

                            <a href="{{route('admin.orderEdit', $order)}}}"><button class="btn btn-primary mr-1">Редактировать заказ</button></a>

                            <a href="{{route('admin.order', $order)}}}"><button class="btn btn-success mr-1">Детали заказа</button></a>

                            <form action="{{route('admin.orderDelete')}}">
                            @csrf
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                @foreach($multipleOrder as $multOrder)
                                <input type="hidden" name="books_id[]" value="{{$multOrder->book_id}}">
                                @endforeach
                                <button type="submit" class = 'btn btn-danger'>Удалить</button>
                            </form>


                        </td>
                @endforeach


                </tbody>

            </table>


        </div>
    </div>
    </div>
        </div>
    </div>

@endsection
