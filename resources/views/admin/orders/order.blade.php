@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_order_container" style="">

        @include('includes.errors')

        <div class="secondary_container">
<div class="row">
    <div class="col-lg-12">
        <div class="page-header orders_title_container">
            <h2 id="tables">Заказ</h2>
        </div>

        <div class="bs-component order_container" >
            <table class="table table-hover" style="background-color: #969b99">

                <thead>
                <tr>
                    <th scope="col">Order number</th>
                    <th scope="col">Customer name</th>
                    <th scope="col">Delivery name</th>
                    <th scope="col">Office number</th>
                    <th scope="col">City</th>
                    <th scope="col">Book name</th>
                    <th scope="col">Book number</th>
                    <th scope="col">Created_at</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Status</th>



                </tr>
                </thead>
                <tbody>

                    <tr class="table-active">
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->delivery->delivery_name}}</td>
                        <td>{{$order->office->office_number}}</td>
                        <td>{{$order->city->city_name}}</td>
                        <td class = "orders_book_td">
                            @foreach($order->books as $book)
                                <pre>{{$book->book_name}} </pre>
                            @endforeach
                        </td>
                        <td class = "orders_book_td">
                            @foreach($multipleOrder as $oneOrder)
                                    <pre>{{$oneOrder->book_number}} </pre>
                                    @endforeach
                        </td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->order_comment}}</td>
                        <td>{{$order->status->status}}</td>




                </tbody>

            </table>

            <a href="{{route('admin.orderEdit', $order)}}}" class="order_link"><button class="btn btn-success ">Редактировать заказ</button></a>
        </div>
    </div>
</div>
        </div>
    </div>

@endsection








