@include('includes.main.head')
@include('includes.admin.navbar')
@include('includes.admin.scripts')
<body style="height: 100vh; background-image: url('/assets/img/Cabinet.jpg')">
@include('includes.errors')
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1 id="tables">Order</h1>
        </div>

        <div class="bs-component">
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
                        <td>{{$order->ukrcity->ukrcity_name}}</td>
                        <td>{{$book->book_name}}</td>
                        <td>{{$book->books_number}}</td>
                        <td>{{$order->order_comment}}</td>
                        <td>{{$order->status->status}}</td>




                </tbody>

            </table>

            <a href="{{route('admin.orderEdit', $order)}}}"><button class="btn btn-success">Редактировать заказ</button></a>
        </div>
    </div>
</div>
</body>








