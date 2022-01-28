@extends('layouts.site.personalCabinet')



@section('content')

<section style="height: 100vh;display: flex; background-image: url(https://img5.goodfon.ru/original/1920x1200/9/81/korabl-sudno-gory-skaly-vodoem-ford-zaliv-norvegiia-oblaka-o.jpg)" >


    @include('includes.errors')

    <div class="cards_container">
        <div class="multiple_order_list_text_container" >Ваш заказ</div>
        <div class="main_container">
        @foreach($booksOrder as $bookOrder)




            <div class="card book_card multiple_order_book_card" id = "multiple_order_book_card">
                <div class = 'book_card_multiple_content'>
                    <div class=" book_card_multiple">
                        @foreach($bookOrder->images as $image)
                            <div class="carousel-item @if($loop->first) active @endif" data-interval="18000000000">
                                <img src="{{asset('/storage/'. $image->images)}}" class="d-block img book_card_multiple"  alt="...">
                            </div>
                        @endforeach
                    </div>


                <div class="card-body">
                    <div class="flex card-body-content">
                        <p class="card-title">Название книги: </p>
                        <p class="card-title card-title-name">{{$bookOrder->book_name}}</p>
                    </div>

                    <div class="flex">
                        <p class="card-title">Имя автора: </p>
                        <p class="card-title card-title-name">{{$bookOrder->author->fullname}}</p>
                    </div>
                    <div class="flex">
                        <p class="card-title card-title-number">Выберите количество: </p>
                        <div class = "quantity_buttons_container number multiple_order_number">
                            <button type="button" class="numberBookOrder decMultipleOrderNumber" style="border: none;  background-color: transparent"  data-book-order-id="{{$bookOrder->id}}">
                                <img src="https://emojitool.ru/img/apple/ios-14.2/minus-2905.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Minus" >
                            </button>
                            <p class = "bookNumber bookNumberMultiple" id="bookNumber{{$bookOrder->id}}" data-book-number="{{$bookOrder->books_number}}">{{$bookOrder->books_number}}</p>
                            <button type="button" class="numberBookOrder incMultipleOrderNumber" style="border: none;background-color: transparent" data-book-order-id="{{$bookOrder->id}}">
                                <img src="https://emojitool.ru/img/apple/ios-14.5/plus-2964.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Minus" >
                            </button>
                        </div>
                    </div>
                    <div class="flex">
                        <p class="card-title">Осталось книг в наличии: </p>
                        <p class="card-title card-title-name" id="bookLimit{{$bookOrder->id}}">{{$bookOrder->books_limit}}</p>
                    </div>

                </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <div class="order_container">
    <div class = "order_text_container">
        <p>Оформление заказа</p>
    </div>


        <form action="{{route('admin.orderCreate')}}" method="POST" id="bookOrderForm">
            @csrf
        <table class="table  order_table multiple_order_table">

            <tbody class ="order_table">

            <th scope="row">Выберите службу доставки</th>
            <td class = "table_row">

                <select class="admin delivery" id="delivery" name="delivery_id" required = "true">
                    <option value=""><label >Служба доставки</label></option>
                    @foreach($deliveries as $delivery)
                        <option value="{{$delivery->id}}" class="option" name="delivery_id">{{$delivery->delivery_name}}</option>

                    @endforeach
                </select>

            </td>


            <tr>
                <th scope="row">Выберите Город</th>
                <td class = "table_row">

                    <select class="admin city disabled_option" name="city_id" required>
                        <option value=""><label >Город</label></option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}" name="city_id" >{{$city->city_name}}</option>
                        @endforeach
                    </select>

                </td>

            </tr>
            <tr>
                <th scope="row">Выберите отделение</th>
                <td colspan="2" class = "table_row">

                    <select class="admin office disabled_option" name="office_id" id="offices" required>
                        <option value=""><label >Отделение</label></option>
                        @foreach($offices as $office)
                            <option value="{{$office->id}}" class="option" >{{$office->office_number}}</option>

                        @endforeach
                    </select>

                </td>
            </tr>

            @if(!\Illuminate\Support\Facades\Auth::user())

            <tr>
                <th scope="row">Введите имя</th>
                <td colspan="2" class = "table_row">

                    <input type="text" name="name" placeholder="Введите имя" class = "inputOrder" required>

                </td>
            </tr>

            <tr>
                <th scope="row">Введите фамилию</th>
                <td colspan="2" class = "table_row">

                    <input type="text" name="surname" placeholder="Введите фамилию" class = "inputOrder" required>

                </td>
            </tr>

            <tr>
                <th scope="row">Введите email</th>
                <td colspan="2" class = "table_row">

                    <input type="email" name="email" placeholder="Введите email" class = "inputOrder" required>

                </td>
            </tr>
            @endauth

            </tbody>
        </table>

        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
        @foreach($booksOrder as $bookOrder)
        <input type="hidden" name="booksOrder[]" value="{{$bookOrder->id}}">
        @endforeach
        <a href="{{route('admin.bookClearBasket')}}" type="button" class="btn btn-secondary btn_multiple_order_cancel btn_clear_basket">Отменить заказ</a>
        <input type="submit" class = 'btn btn-secondary btn_book_order btn_book_multiple_order ' value="Оформить заказ">



    </form>



</div>
</section>

@include('includes.main.script_multiple_order')

@endsection




{{--<script--}}
{{--    src="https://code.jquery.com/jquery-3.6.0.js"--}}
{{--    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="--}}
{{--    crossorigin="anonymous">--}}
{{--</script>--}}

{{--<script>--}}

{{--    //------------------------------------Изменение количества----------------------------------------------------------------}}

{{--    let changeQuantity = function(quantity, book_id){--}}
{{--        let parentButtons = document.querySelector('.quantity_buttons_container');--}}
{{--        parentButtons.classList.add('disabled')--}}


{{--        $.ajax({--}}
{{--            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},--}}
{{--            url : `/admin/books/book/changeQuantity`,--}}
{{--            method: "Post" ,--}}
{{--            data:{'book_id': book_id, 'quantity': quantity},--}}

{{--            success: function (response)--}}
{{--            {--}}
{{--                parentButtons.classList.remove('disabled');--}}
{{--                let bookNumber = document.getElementById(`bookNumber${response.book.id}`)--}}
{{--                let bookLimit = document.getElementById(`bookLimit${response.book.id}`)--}}
{{--                bookLimit.innerText = response.book.books_limit--}}
{{--                bookNumber.innerText = response.number--}}

{{--            }--}}
{{--        })--}}

{{--    }--}}

{{--    $(".decMultipleOrderNumber").on('click', function (e) {--}}


{{--        let book_id = e.currentTarget.dataset.bookOrderId--}}

{{--        changeQuantity(-1, book_id)--}}

{{--    })--}}

{{--    $(".incMultipleOrderNumber").on('click', function (e){--}}

{{--        let book_id = e.currentTarget.getAttribute('data-book-order-id')--}}

{{--        changeQuantity(1, book_id)--}}

{{--    })--}}


{{--    //------------------------------------Отделения доставки--------------------------------------------------------------}}

{{--$(".delivery").change(function (){--}}

{{--    let delivery_id = document.getElementById('delivery').value--}}

{{--    $.ajax({--}}
{{--        type: 'POST',--}}
{{--        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},--}}
{{--        url: `/admin/cities/show` ,--}}
{{--        data: {'delivery_id': delivery_id},--}}


{{--        success: function (response)--}}
{{--        {--}}
{{--            let city = document.querySelector('.city')--}}
{{--            city.classList.remove('disabled_option')--}}

{{--            let newCities =  response.cities;--}}

{{--            function createOptions(arr) {--}}

{{--                let options = arr.map(function (city){--}}
{{--                    let option = document.createElement('option');--}}
{{--                    option.value = city.id--}}
{{--                    option.innerText = city.city_name--}}
{{--                    return option--}}
{{--                })--}}
{{--                let option = document.createElement('option');--}}
{{--                option.innerText = 'Город'--}}
{{--                options.unshift(option)--}}
{{--                return options;--}}
{{--            }--}}

{{--            let allCities = document.querySelector('.city')--}}

{{--            while (allCities.firstChild) {--}}
{{--                allCities.removeChild(allCities.firstChild);--}}
{{--            }--}}

{{--            let newOptions = createOptions(newCities)--}}

{{--            for (let option of newOptions){--}}
{{--                allCities.appendChild(option);--}}
{{--            }--}}
{{--        }--}}
{{--    })--}}
{{--})--}}


{{--$(".city").change(function (){--}}

{{--    let city_id = document.querySelector('.city').value--}}
{{--    let delivery_id = document.querySelector('.delivery').value--}}

{{--    $.ajax({--}}
{{--        type: 'POST',--}}
{{--        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},--}}
{{--        url: `/offices/show` ,--}}
{{--        data: {'city_id': city_id, 'delivery_id': delivery_id},--}}


{{--        success: function (response)--}}
{{--        {--}}
{{--            let office = document.querySelector('.office')--}}
{{--            office.classList.remove('disabled_option');--}}

{{--            let newOffices =  response.offices;--}}

{{--            function createOptions(arr) {--}}

{{--                let options = arr.map(function (office){--}}
{{--                    let option = document.createElement('option');--}}
{{--                    option.value = office.id--}}
{{--                    option.innerText = office.office_number--}}
{{--                    return option--}}
{{--                })--}}
{{--                let option = document.createElement('option');--}}
{{--                option.innerText = 'Отделение'--}}
{{--                options.unshift(option)--}}
{{--                return options;--}}
{{--            }--}}

{{--            let allOffices = document.querySelector('.office')--}}

{{--            while (allOffices.firstChild) {--}}
{{--                allOffices.removeChild(allOffices.firstChild);--}}
{{--            }--}}

{{--            let newOptions = createOptions(newOffices)--}}

{{--            for (let option of newOptions){--}}
{{--                allOffices.appendChild(option);--}}
{{--            }--}}
{{--        }--}}
{{--    })--}}
{{--})--}}



{{--</script>--}}

{{--</body>--}}



