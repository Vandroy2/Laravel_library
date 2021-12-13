@include('includes.main.head')
@include('includes.main.personalNav')
@include('includes.admin.scripts')
<body style="background-image: url(https://www.las.ru/media/foto/kabinet-rukovoditelya-enosi-evo-foto-01-a.jpg)">

@include('includes.errors')
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1 id="tables">Orders</h1>
        </div>
        <div class="bs-component">
            <table class="table table-hover"; style="background-color: #969b99">
                <thead>
                <tr>
                    <th scope="col">Order number</th>
                    <th scope="col">Book name</th>
                    <th scope="col">City</th>
                    <th scope="col">Delivery</th>
                    <th scope="col">Office number</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="table-active">
                        <th scope="row">{{$order->id}}</th>

                        <td>
                            @foreach($order->books as $book)
                            {{$book->book_name}}
                            @endforeach
                        </td>

                        <td>{{$order->city->city_name}}</td>
                        <td>{{$order->delivery->delivery_name}}</td>
                        <td>{{$order->office->office_number}}</td>
                        <td>{{$order->status->status}}</td>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
