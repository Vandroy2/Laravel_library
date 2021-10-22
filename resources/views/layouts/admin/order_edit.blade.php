@include('includes.admin.head')

<body style="margin-left: 15px">
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')

<meta name="csrf-token" content="{{ csrf_token() }}">


<form action="{{route('admin.orderUpdate', $order)}}" data-order-id="{{$order->id}}" data-book-id="{{$bookOrder->id}}" method = "Post" enctype="multipart/form-data" id="orderForm">

    @csrf

    <div class="form-group">
        <h6>Номер заказа</h6>
        <h6>{{$order->id}}</h6>

    </div>


    <div class="form-group">
        <h6>Служба доставки</h6>
        <select class="admin orderDelivery" name="delivery_id" id="orderDelivery">
            <option value="{{$order->delivery->id}}" ><label >{{$order->delivery->delivery_name}}</label></option>
            @foreach($deliveries as $delivery)
                <option value="{{$delivery->id}}" class="option" name="delivery_id">{{$delivery->delivery_name}}</option>

            @endforeach
        </select>
    </div>

    <div class="form-group" >
        <h6>Номер отделения</h6>
        <select class="admin office" name="office_id" id="orderOffices">
            <option value="{{$order->office->id}}" ><label class="admin_label" >{{$order->office->office_number}}</label></option>

            @foreach($offices as $office)
                <option value="{{$office->id}}" class="option" >{{$office->office_number}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <h6>Название книги</h6>
        <select class="admin office bookOrder" name="book_id" id="bookOption">
            <option value="{{$bookOrder->id}}"><label class="admin_label" >{{$bookOrder->book_name}}</label></option>

            @foreach($books as $book)
                <option value="{{$book->id}}" class="option"  >{{$book->book_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <h6>Город</h6>
        <select class="admin office" name="ukrcity_id">
            <option value="{{$order->ukrcity->id}}"><label class="admin_label" >{{$order->ukrcity->ukrcity_name}}</label></option>

            @foreach($ukrcities as $ukrcity)
                <option value="{{$ukrcity->id}}" class="option" >{{$ukrcity->ukrcity_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <h6>Статус заказа</h6>
        <select class="admin office" name="status_id" >
            <option value="{{$order->status->id}}"><label class="admin_label" >{{$order->status->status}}</label></option>
            @foreach($status as $stat)

                <option value="{{$stat->id}}" class="option" >{{$stat->status}}</option>

            @endforeach
        </select>
    </div>


    <div class="form-group">


        <div style="display: flex">
            <h6>Количество книг в заказе</h6>
            <h6 style="color: red; margin-left: 10px;">При повторном редактировании названия книги нужно выполнить сброс количества книг в заказе до 0</h6>


        </div>

        <div class = "book_number number quantity_order_buttons_container" style="display: flex" >
            <button data-url="{{route('admin.orderBookDecNumber')}}" type="button" class = "numberBookOrder" style="border: none; background-color: white; height: 10px" id="decOrderBookNumber">
                <img src="https://emojitool.ru/img/apple/ios-14.2/minus-2905.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Minus" >
            </button>

            <p class = "orderBookNumber" id="orderBookNumber" style="display: block;" data-book-number="{{$order->book_number}}">{{$order->book_number}}</p>

            <button data-url="{{route('admin.orderBookIncNumber')}}" type="button" class = "numberBookOrder" style="border: none; background-color: white; height: 10px"  id="incOrderBookNumber">
                <img src="https://emojitool.ru/img/apple/ios-14.5/plus-2964.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Plus" >
            </button>

        </div>

        <h6 id="orderBookLimit">Количeство книг в библиотеке: {{$bookOrder->books_limit}}</h6>
    </div>
    <div class="form-group" style="margin-top: 0">
        <label for="name"></label>
        <input type="text" name="order_comment" value="{{$order->order_comment}}" placeholder="Оставьте комментарий" class="form-control" style="width: 300px; height: 100px">
    </div>


    <button type="submit" id="submit" class="btn btn-success">Edit order</button>


</form>
</body>


<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>

<script>
    //=============================Количество книг===============================================================
    $(function () {
        $(".bookOrder").change(function () {
            let form = document.getElementById('orderForm')
            let id = form.getAttribute('data-order-id')
            let book_id = document.getElementById('bookOption').value
            let reset = 'reset';


            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                url: `/admin/orders/edit/${id}`,
                data: {'book_id': book_id, 'reset':reset},

                success: function (response){

                    let orderBookLimit = document.getElementById('orderBookLimit')
                    let orderBookNumber = document.getElementById('orderBookNumber')
                    // console.log(response.order.book_number);
                    console.log(response.bookOrder.id);

                    orderBookLimit.innerText = `Количество книг в библиотеке: ${response.bookOrder.books_limit}` ;
                    orderBookNumber.innerText = response.order.book_number;

                }
            })
        });
    })


    //=============================Изменения количества===============================================================



    let changeBookOrderQuantity = function (quantity){

        let buttonsContainer = document.querySelector('.quantity_order_buttons_container');
        buttonsContainer.classList.add('disabled');
        let form = document.getElementById('orderForm')
        let id = form.getAttribute('data-order-id')
        let book_id = document.getElementById('bookOption').value

        $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            method: "Post",
            url: `/admin/orders/edit/${id}`,
            data:{'quantity':quantity, 'book_id':book_id},

            success: function (response){

                buttonsContainer.classList.remove('disabled')
                let orderBookLimit = document.getElementById('orderBookLimit')
                let orderBookNumber = document.getElementById('orderBookNumber')
                console.log(response.order.book_number);
                console.log(response.bookOrder.books_limit);
                orderBookLimit.innerText = `Количество книг в библиотеке: ${response.bookOrder.books_limit}`;
                orderBookNumber.innerText = response.order.book_number;
            }
        })
    }
    $("#decOrderBookNumber").on('click', function (){
        changeBookOrderQuantity(-1);
    })

    $("#incOrderBookNumber").on('click', function (){
        changeBookOrderQuantity(1);
    })




    // //=============================Отделения доставки===============================================================
    //
    $("#orderDelivery").change(function (){

        let form = document.getElementById('orderForm')
        let id = form.getAttribute('data-order-id')
        let delivery_id = document.getElementById('orderDelivery').value

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: `/admin/orders/edit/${id}` ,
            data: {'delivery_id': delivery_id},

            success: function (response)
            {
                let newOffices =  response.offices;

                function createOptions(arr) {

                    return arr.map(function (office) {
                        let option = document.createElement('option');
                        option.value = office.office_number
                        option.innerText = `№ ${office.office_number} some address`
                        return option
                    });
                }

                let allOffices = document.getElementById('orderOffices')

                while (allOffices.firstChild) {
                    allOffices.removeChild(allOffices.firstChild);
                }

                let newOptions = createOptions(newOffices)

                for (let option of newOptions){
                    allOffices.appendChild(option);
                }
            }
        })
    })


    //=============================Увеличение количества===============================================================

    // function handleClick(num) {
    //     console.log(num)
    // }

    //     $(".numberBookOrder").on('click', function (e) {
    //         e.preventDefault();
    //     })
    //
    //             let form = document.getElementById('orderForm')
    //             let id = form.getAttribute('data-order-id')
    //
    //
    //             $.ajax({
    //
    //                 url : `/admin/orders/edit/${id}`,
    //                 method: "GET" ,
    //
    //                 success: function (response)
    //                 {
    //
    //                     let number_2 = document.getElementById('number_2')
    //
    //                     let num = number_2.innerText
    //
    //                     if (num > 1){
    //
    //                         num -=1
    //
    //                         number_2.innerText = num
    //
    //                     }
    //                     if (num < response.bookOrder.books_limit){
    //
    //                         num +=1
    //
    //                         number_2.innerText = num
    //                 }
    //             }
    //
    //     })
    // }
    //
    // let number =  bookOrder.books_number;
    //
    // num = number;
    //
    // handleClick(num);

    // $(".numberBookOrder").on('click', function (e) {
    //            e.preventDefault();
    //        })
    //
    // function handleClick(num){
    //     console.log(num);
    // }



        </script>





















