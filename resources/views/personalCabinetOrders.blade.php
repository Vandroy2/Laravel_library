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
            <table class="table table-hover">

                <thead>
                <tr>
                    <th scope="col">Book id</th>
                    <th scope="col">City id</th>
                    <th scope="col">Delivery id</th>
                    <th scope="col">Status</th>
                </tr>

                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="table-active">
                        <td>{{$order->book_id}}</td>
                        <td>{{$order->ukrcity_id}}</td>
                        <td>{{$order->delivery_id}}</td>
                        <td>{{$order->status_id}}</td>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
