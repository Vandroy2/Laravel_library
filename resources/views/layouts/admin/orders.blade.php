@include('includes.main.head')
@include('includes.admin.navbar')
@include('includes.admin.scripts')
<body style="height: 100vh; background-image: url(https://ergomebel.ru/upload/iblock/326/3269dfb3c768f5685a652b74810466b6.jpg)">
@include('includes.errors')
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1 id="tables">Orders</h1>
        </div>

        <div class="bs-component">
            <table class="table table-hover">

                <thead>
                <tr>
                    <th scope="col">Order number</th>
                    <th scope="col">User name</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operations</th>


                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="table-active">
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->order_comment}}</td>
                        <td>{{$order->status->status}}</td>




                        <td>

                            <a href="{{route('admin.order', $order)}}}"><button class="btn btn-success">Детали заказа</button></a>

                            <a href="{{route('admin.orderDelete', $order)}}"><button class="btn btn-danger">Удалить</button></a>


                        </td>
                @endforeach


                </tbody>

            </table>


        </div>
    </div>
    </div>
</body>
