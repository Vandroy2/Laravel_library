<?php
/* @var \App\Models\Order $order */
?>

@include('includes.admin.head')

<body style="margin-left: 15px">
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')

<meta name="csrf-token" content="{{ csrf_token() }}">

<form action="{{route('admin.orderUpdate', $order)}}"
      class="orderForm"
      data-order-id="{{$order->id}}"
      method="post"
      id="orderForm">
    @csrf

    <div class="form-group">
        <h6>Номер заказа</h6>
        <h6>{{$order->id}}</h6>

    </div>

    <div class="form-group">
        <h6>Служба доставки</h6>
        <select class="admin orderDelivery delivery" name="delivery_id" id="orderDelivery" required>
            <option value="{{$order->delivery->id}}"><label>{{$order->delivery->delivery_name}}</label></option>
            @foreach($deliveries as $delivery)
                <option value="{{$delivery->id}}" class="option"
                        name="delivery_id">{{$delivery->delivery_name}}</option>

            @endforeach
        </select>
    </div>

    <div class="form-group">
        <h6>Город</h6>
        <select class="admin city disabled_option" name="city_id" required>
            <option value="{{$order->city->id}}"><label class="admin_label">{{$order->city->city_name}}</label>
            </option>

            @foreach($cities as $city)
                <option value="{{$city->id}}" class="option">{{$city->city_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <h6>Номер отделения</h6>
        <select class="admin office disabled_option" name="office_id" id="orderOffices" required>
            <option value="{{$order->office->id}}"><label
                    class="admin_label">{{$order->office->office_number}}</label></option>

            @foreach($offices as $office)
                <option value="{{$office->id}}" class="option">{{$office->office_number}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <h6>Статус заказа</h6>
        <select class="admin office" name="status_id">
            <option value="{{$order->status->id}}"><label class="admin_label">{{$order->status->status}}</label>
            </option>
            @foreach($status as $stat)

                <option value="{{$stat->id}}" class="option">{{$stat->status}}</option>

            @endforeach
        </select>
    </div>

    <div class="form-group flex">

        <table class="table table-order-edit"
               style="background-color: #ebefee; width: 35%; margin-right: 0;display:inline-table;text-align: center">

            <thead>
            <tr>

                <th scope="col">Book name</th>
                <th scope="col">Book quantity in library</th>
                <th scope="col">Change quantity</th>
                <th scope="col">Book delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->orderBooks as $i => $bookOrder)


                <tr>
                    <td>
                        <select class="admin office bookOrder" name="books[{{ $i }}][book_id]"
                                id="bookOption{{$bookOrder->book_id}}" data-book-order-id='{{$bookOrder->book_id}}' data-order-id = "{{$order->id}}">

                            <option value="{{$bookOrder->book_id}}" id="bookOrderOption{{$bookOrder->book_id}}"><label
                                    class="admin_label">{{$bookOrder->book->book_name}}</label></option>

                            @foreach($books as $book)
                                <option value="{{$book->id}}" class="option">{{$book->book_name}}</option>

                            @endforeach
                        </select>
                    </td>


                    <td class="bookOrderLimit">
                        {{$bookOrder->book->books_limit}}

                    </td>

                    <td class = "quantity_popup_buttons_container">
                        <button data-url="" type="button" class="decNumberBookOrder" data-book-order-id="{{$bookOrder->book_id}}" data-order-id = "{{$order->id}}"
                                style="border: none; background-color: transparent; height: 10px"
                                id="decNumber{{$bookOrder->id}}">
                            <img src="https://emojitool.ru/img/apple/ios-14.2/minus-2905.png"
                                 style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Minus">
                        </button>

                        <input class="order_book_number" style="width: 25px; text-align: center;" type="text" name="books[{{ $i }}][book_number]" value="{{ $bookOrder->book_number }}" />

                        <input class="order_book_limit_hidden" style="width: 25px; text-align: center;" type="hidden" name="books[{{ $i }}][books_limit]" value="{{ $bookOrder->book->books_limit }}" />

                        <button data-url="" type="button" class="incNumberBookOrder" data-book-order-id="{{$bookOrder->book_id}}" data-order-id = "{{$order->id}}"
                                style="border: none; background-color: transparent; height: 10px"
                                id="incNumber{{$bookOrder->id}}">
                            <img src="https://emojitool.ru/img/apple/ios-14.5/plus-2964.png"
                                 style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px; background-color: transparent;" alt="Plus">
                        </button>
                    </td>

                    <td class="deleteBookOrderContainer">
                        <button data-url="" type="button" class="deleteBookOrder" data-book-order-id="{{$bookOrder->book_id}}" data-order-id = "{{$order->id}}"
                                style="border: none; background-color: transparent; height: 10px"
                                id="deleteBookOrder{{$bookOrder->id}}">
                            <img src="/assets/img/garbage_basket.jpeg"
                                 style="width: 25px; height: 25px;margin-left: 5px;background-color: transparent; margin-right: 5px" alt="Plus">
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div style="width: 100%; height: 10px">

    </div>

    <div class="form-group" style="margin-top: 0">
        <label for="name"></label>
        <input type="text" name="order_comment" value="{{$order->order_comment}}" placeholder="Оставьте комментарий"
               class="form-control" style="width: 300px; height: 100px">
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


    //======================================Удаление книги==============================================================

    $(function (){

        $('.deleteBookOrder').on('click', function (e){

            let tr = e.currentTarget.closest('tr')

            tr.remove();

            let bookOrder = tr.querySelector('.bookOrder');

            let order_book_number = tr.querySelector('.order_book_number')

            let book_id = bookOrder.value

            let order_id = bookOrder.getAttribute('data-order-id');

            let book_number = Number(order_book_number.getAttribute('value'));

            $.ajax({

                type:'POST',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                url: '/admin/orders/deleteBookOrder',
                data:{'delete_book_id': book_id, 'order_id': order_id, 'book_number':book_number},

                success:function (response){
                }
            })
        })
    });

    //=============================Количество книг======================================================================

    $(function () {

        $(".bookOrder").change(function (e) {

            let book_id = e.currentTarget.value
            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                url: `/admin/books/book/limit`,
                data: {'book_id': book_id},

                success: function (response) {

                    let tr = e.currentTarget.closest('tr')

                    let bookOrderLimit = tr.querySelector('.bookOrderLimit')

                    bookOrderLimit.innerText = response.bookOrder.books_limit;
                }
            })
        });
    })

    //=============================Изменения количества===============================================================

    $(function () {

        $(".bookOrder").change(function (e) {

            let tr = e.currentTarget.closest('tr')

            let order_book_number = tr.querySelector('.order_book_number');

            order_book_number.setAttribute('value', 0);
        });
    })

    let changeQuantity = function(quantity, book_id, e)
    {

                let cont = e.currentTarget.closest('tr')

                let bookOrderLimit = cont.querySelector('.bookOrderLimit')

                let limit = bookOrderLimit.innerText;

                let order_book_limit_hidden = cont.querySelector('.order_book_limit_hidden')

                let bookOrderNumberInput = cont.querySelector('.order_book_number')

                let bookOrderNumber = Number(bookOrderNumberInput.getAttribute('value'));

                if (limit > 0 && quantity > 0)
                {
                    bookOrderNumber += quantity;

                    bookOrderNumberInput.setAttribute('value', bookOrderNumber)

                    limit -= quantity;

                    bookOrderLimit.innerText = limit

                    order_book_limit_hidden.setAttribute('value', limit)

                }

                    if (Number(bookOrderNumberInput.getAttribute('value')) > 1 && quantity < 1)
                {
                    limit -= quantity;

                    bookOrderLimit.innerText = limit

                    order_book_limit_hidden.setAttribute('value', limit)

                    bookOrderNumber += quantity;

                    bookOrderNumberInput.setAttribute('value', bookOrderNumber)
                }
    }

    $(".decNumberBookOrder").on('click', function (e){

        let tr = e.currentTarget.closest('tr')

        let bookOrder = tr.querySelector('.bookOrder ');

        let book_id = bookOrder.value

        changeQuantity (-1, book_id, e);
    })

    $(".incNumberBookOrder").on('click', function (e){

        let tr = e.currentTarget.closest('tr')

        let bookOrder = tr.querySelector('.bookOrder ');

        let book_id = bookOrder.value

        changeQuantity(1, book_id, e);
    })


//=====================================Отделения доставки===============================================================

    $(".delivery").change(function () {

        let delivery_id = document.querySelector('.delivery').value
        console.log(delivery_id);

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: `/admin/cities/show`,
            data: {'delivery_id': delivery_id},

            success: function (response) {
                console.log(response)

                let city = document.querySelector('.city')
                city.classList.remove('disabled_option')

                let newCities = response.cities;

                function createOptions(arr) {

                    let options = arr.map(function (city) {
                        let option = document.createElement('option');
                        option.value = city.id
                        option.innerText = city.city_name
                        return option
                    })
                    let option = document.createElement('option');
                    option.innerText = 'Город'
                    options.unshift(option)
                    return options;
                }

                let allCities = document.querySelector('.city')

                while (allCities.firstChild) {
                    allCities.removeChild(allCities.firstChild);
                }

                let newOptions = createOptions(newCities)

                for (let option of newOptions) {
                    allCities.appendChild(option);
                }
            }
        })
    })

    $(".city").change(function () {

        let city_id = document.querySelector('.city').value
        let delivery_id = document.querySelector('.delivery').value

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: `/offices/show`,
            data: {'city_id': city_id, 'delivery_id': delivery_id},


            success: function (response) {
                let office = document.querySelector('.office')
                office.classList.remove('disabled_option');

                let newOffices = response.offices;

                function createOptions(arr) {

                    let options = arr.map(function (office) {
                        let option = document.createElement('option');
                        option.value = office.id
                        option.innerText = office.office_number
                        return option
                    })
                    let option = document.createElement('option');
                    option.innerText = 'Отделение'
                    options.unshift(option)
                    return options;
                }

                let allOffices = document.querySelector('.office')

                while (allOffices.firstChild) {
                    allOffices.removeChild(allOffices.firstChild);
                }

                let newOptions = createOptions(newOffices)

                for (let option of newOptions) {
                    allOffices.appendChild(option);
                }
            }
        })
    })
</script>






























