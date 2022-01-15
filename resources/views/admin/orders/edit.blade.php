<?php
/* @var \App\Models\Order $order */
?>

@include('includes.main.head')

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
        <h6 class = "orderEditSelectText">Служба доставки</h6>
        <select class="admin orderDelivery delivery" name="delivery_id" id="orderDelivery" required>
            <option value="{{$order->delivery->id}}"><label>{{$order->delivery->delivery_name}}</label></option>
            @foreach($deliveries as $delivery)
                <option value="{{$delivery->id}}" class="option"
                        name="delivery_id">{{$delivery->delivery_name}}</option>

            @endforeach
        </select>
    </div>

    <div class="form-group">
        <h6 class = "orderEditSelectText">Город</h6>
        <select class="admin city disabled_option" name="city_id" required style="pointer-events: none">
            <option value="{{$order->city->id}}"><label class="admin_label">{{$order->city->city_name}}</label>
            </option>

            @foreach($cities as $city)
                <option value="{{$city->id}}" class="option">{{$city->city_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <h6 class = "orderEditSelectText">Номер отделения</h6>
        <select class="admin office disabled_option" name="office_id" id="orderOffices" required style="pointer-events: none">
            <option value="{{$order->office->id}}"><label
                    class="admin_label">{{$order->office->office_number}}</label></option>

            @foreach($offices as $office)
                <option value="{{$office->id}}" class="option">{{$office->office_number}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-group">
        <h6 class = "orderEditSelectText">Статус заказа</h6>
        <select class="admin office" name="status_id">
            <option value="{{$order->status->id}}"><label class="admin_label">{{$order->status->status}}</label>
            </option>
            @foreach($status as $stat)

                <option value="{{$stat->id}}" class="option">{{$stat->status}}</option>

            @endforeach
        </select>
    </div>

    <div class="form-group flex-column tableContainer">

        <table class="table table-order-edit"
               style="background-color: #ebefee; width: 40%; margin-right: 0;display:inline-table;text-align: center">

            <thead>
            <tr>

                <th scope="col">Book name</th>
                <th scope="col">Book quantity in library</th>
                <th scope="col">Change quantity</th>
                <th scope="col">Book delete</th>
                <th scope="col">Book add</th>
            </tr>
            </thead>
            <tbody class = "orderTableBody">
            @foreach($order->orderBooks as $i => $bookOrder)



                <tr data-book-id="{{ $bookOrder->book_id }}">
                    <td>
                        <select class="admin office bookOrder" name="books[{{ $i }}][book_id]"
                                id="bookOption{{$bookOrder->book_id}}" data-book-order-id='{{$bookOrder->book_id}}' data-order-id = "{{$order->id}}">

                            <option value="{{$bookOrder->book_id}}" id="bookOrderOption{{$bookOrder->book_id}}">
                                <label
                                    class="admin_label">{{$bookOrder->book->book_name}}
                                </label>
                            </option>

                            @foreach($books as $book)
                                <option value="{{$book->id}}" class="option">{{$book->book_name}}</option>



                            @endforeach
                        </select>
                    </td>


                    <td class="bookOrderLimit">
                        {{$bookOrder->book->books_limit}}
                    </td>

                    <td class="quantity_popup_buttons_container">
                        <button  type="button" class="decNumberBookOrder decNumberEditBookOrder" data-book-order-id="{{$bookOrder->book_id}}" data-order-id = "{{$order->id}}"

                                id="decNumber{{$bookOrder->id}}">
                            <img src="https://emojitool.ru/img/apple/ios-14.2/minus-2905.png" class = "minusImg"
                                 alt="Minus">
                        </button>

                        <input class="order_book_number inputNumber book-quantity" type="text" name="books[{{ $i }}][book_number]" data-book-id="{{ $bookOrder->book_id }}" data-old-value="{{ $bookOrder->book_number }}" value="{{ $bookOrder->book_number }}" />

                        <input class="order_book_limit_hidden" style="width: 25px; text-align: center;" type="hidden" name="books[{{ $i }}][books_limit]" value="{{ $bookOrder->book->books_limit }}" />

                        <button  type="button" class="incNumberBookOrder" data-book-order-id="{{$bookOrder->book_id}}" data-order-id = "{{$order->id}}"
                                style="border: none; background-color: transparent; height: 10px"
                                id="incNumber{{$bookOrder->id}}">
                            <img src="https://emojitool.ru/img/apple/ios-14.5/plus-2964.png"
                                 style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px; background-color: transparent;" alt="Plus">
                        </button>
                    </td>

                    <td class="deleteBookOrderContainer">
                        <button  type="button" class="deleteBookOrder" data-book-order-id="{{$bookOrder->book_id}}" data-order-id = "{{$order->id}}"
                                style="border: none; background-color: transparent; height: 10px"
                                id="deleteBookOrder{{$bookOrder->id}}">
                            <img src="/assets/img/garbage_basket.jpeg"
                                 style="width: 25px; height: 25px;margin-left: 5px;background-color: transparent; margin-right: 5px" alt="Plus">
                        </button>
                    </td>

                    <td >
                        <button type="button" class = "addBookOrderBtn" data-book-order-id="{{$bookOrder->book_id}}" data-order-id = "{{$order->id}}" id="addBookOrder{{$bookOrder->id}}">
                            <img src="/assets/img/add.png" class = "addBookIcon" alt="icon">
                        </button>

                    </td>
                </tr>


            @endforeach
            </tbody>
        </table>

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

    //======================================Количество книг в заказе ===================================================



    $(document).on('change', '.book-quantity',function (e) {



        let $bookQuantity = $(this);

        let bookId = $bookQuantity.attr('data-book-id');

        let $wrap = $bookQuantity.closest('tr[data-book-id="' + bookId + '"]');

        let bookLimitHidden = $wrap.find('td input[type="hidden"].order_book_limit_hidden')

        let oldBookQuantity = +$bookQuantity.attr('data-old-value');

        let newBookQuantity = +e.target.value;

        let $bookLimit = $wrap.find('td.bookOrderLimit');

        let oldBookLimit = +$bookLimit.text().trim();

        console.log(oldBookQuantity, oldBookLimit);

        if((oldBookLimit + oldBookQuantity) < newBookQuantity || newBookQuantity <= 0) {

           $bookQuantity.val(oldBookQuantity)

            return;
        }

        if(newBookQuantity > oldBookQuantity) {

            $bookLimit.text(oldBookLimit-(newBookQuantity-oldBookQuantity));
        } else {

            $bookLimit.text(oldBookLimit+(oldBookQuantity-newBookQuantity));

        }

        bookLimitHidden.attr('value', +$bookLimit.text())

        $bookQuantity.attr('data-old-value', newBookQuantity);

    })


    //======================================Добавление книги============================================================

    $(function (){

       let i = 1000
        $(document).on('click', '.addBookOrderBtn', function (){

            let bookOrder = document.querySelector('.bookOrder')
            let order_id = bookOrder.getAttribute('data-order-id');
            let add = 'add'
            i +=1;

            $.ajax({
                type:'POST',
                    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                    url: '/admin/books/book/add',
                    data:{'add': add, 'order_id': order_id},

                    success:function (response){

                            let orderTableBody = document.querySelector('.orderTableBody')
                            let tr = document.createElement('tr')

                            orderTableBody.appendChild(tr)

                            let tdBookSelect = document.createElement('td')
                            tr.appendChild(tdBookSelect)

                            let selectBook = document.createElement('select')
                            tdBookSelect.appendChild(selectBook)
                            selectBook.classList.add('bookOrder')
                            selectBook.classList.add('admin')
                            selectBook.classList.add('office')
                            selectBook.setAttribute('data-order-id', `${response.order.id}`)
                            selectBook.setAttribute('name',  `books[${i}][book_id]`)

                            let defaultBookOption = document.createElement('option')
                            selectBook.appendChild(defaultBookOption)

                            let labelDefaultBookOption = document.createElement('label')
                            defaultBookOption.appendChild(labelDefaultBookOption);
                            labelDefaultBookOption.classList.add('admin_label')
                            labelDefaultBookOption.innerText = 'Выберите книгу';

                            response.books.forEach(function (book){

                                let bookOption = document.createElement('option')
                                selectBook.appendChild(bookOption)
                                bookOption.setAttribute('value', book.id)
                                bookOption.classList.add('option')
                                bookOption.innerText = book.book_name
                            });

                            let tdBookLimit = document.createElement('td')
                            tr.appendChild(tdBookLimit)
                            tdBookLimit.classList.add('bookOrderLimit')
                            tdBookLimit.innerText = '-'

                            let tdButtonContainer = document.createElement('td')
                            tr.appendChild(tdButtonContainer)
                            tdButtonContainer.classList.add('quantity_popup_buttons_container')

                            let btnDecQuantity = document.createElement('button')
                            tdButtonContainer.appendChild(btnDecQuantity)
                            btnDecQuantity.setAttribute('type', 'button')
                            btnDecQuantity.setAttribute('data-book-order-id', 0)
                            btnDecQuantity.setAttribute('data-order-id', response.order.id)
                            btnDecQuantity.classList.add('decNumberBookOrder')
                            btnDecQuantity.classList.add('decNumberEditBookOrder')
                            btnDecQuantity.id = 0

                            let minus = document.createElement('img')
                            btnDecQuantity.appendChild(minus)
                            minus.setAttribute('src', 'https://emojitool.ru/img/apple/ios-14.2/minus-2905.png')
                            minus.classList.add('minusImg')
                            minus.setAttribute('alt', 'Minus')


                            let inputNumber = document.createElement('input')
                            tdButtonContainer.appendChild(inputNumber)
                            inputNumber.classList.add('order_book_number')
                            inputNumber.classList.add('inputNumber')
                            inputNumber.classList.add('book-quantity')
                            inputNumber.setAttribute('data-book-id', 0)
                            inputNumber.setAttribute('data-old-value', 0);
                            inputNumber.setAttribute('type', 'text')
                            inputNumber.setAttribute('name', `books[${i}][book_number]`)

                            let inputLimit = document.createElement('input')
                            tdButtonContainer.appendChild(inputLimit)
                            inputLimit.classList.add('order_book_limit_hidden')
                            inputLimit.classList.add('inputNumber')
                            inputLimit.setAttribute('type', 'hidden')
                            inputLimit.setAttribute('name', `books[${i}][books_limit]`)
                            inputNumber.setAttribute('value', '-')

                            let btnIncQuantity = document.createElement('button')
                            tdButtonContainer.appendChild(btnIncQuantity)
                            btnIncQuantity.setAttribute('type', 'button')
                            btnIncQuantity.setAttribute('data-book-order-id', 0)
                            btnIncQuantity.setAttribute('data-order-id', response.order.id)
                            btnIncQuantity.classList.add('incNumberBookOrder')
                            btnIncQuantity.classList.add('decNumberEditBookOrder')
                            btnIncQuantity.id = 0

                            let plus = document.createElement('img')
                            btnIncQuantity.appendChild(plus)
                            plus.setAttribute('src', 'https://emojitool.ru/img/apple/ios-14.5/plus-2964.png')
                            plus.classList.add('minusImg')

                            let tdDeleteBook = document.createElement('td')
                            tr.appendChild(tdDeleteBook)
                            tdDeleteBook.classList.add('deleteBookOrderContainer')

                            let btnDeleteBook = document.createElement('button')
                            tdDeleteBook.appendChild(btnDeleteBook)
                            btnDeleteBook.setAttribute('type', 'button')
                            btnDeleteBook.classList.add('deleteBookOrder')
                            btnDeleteBook.classList.add('decNumberEditBookOrder')

                            let imgDeleteBook = document.createElement('img')
                            btnDeleteBook.appendChild(imgDeleteBook)
                            imgDeleteBook.setAttribute('src', '/assets/img/garbage_basket.jpeg')
                            imgDeleteBook.setAttribute('alt', 'Plus')
                            imgDeleteBook.classList.add('imgDeleteBook')

                            let tdAddBook = document.createElement('td')
                            tr.appendChild(tdAddBook)

                            let btnAddBook = document.createElement('button')
                            tdAddBook.appendChild(btnAddBook)
                            btnAddBook.setAttribute('type', 'button')
                            btnAddBook.classList.add('addBookOrderBtn')

                            let imgAddBook = document.createElement('img')
                            btnAddBook.appendChild(imgAddBook)
                            imgAddBook.setAttribute('src', '/assets/img/add.png')
                            imgAddBook.classList.add('addBookIcon')
                            imgAddBook.setAttribute('alt', 'Icon')
                        }



            })
        });
    });

    //======================================Удаление книги==============================================================

    $(function (){

        $(document).on('click','.deleteBookOrder', function (e){

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

        $(document).on('change', '.bookOrder',function (e) {

            let book_id = e.currentTarget.value

            $.ajax({
                type: 'POST',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                url: `/admin/books/book/limit`,
                data: {'book_id': book_id},

                success: function (response) {

                    let tr = e.currentTarget.closest('tr')

                    tr.setAttribute('data-book-id', response.bookOrder.id)

                    let inputNumber = tr.querySelector('.inputNumber')

                    let btnDecQuantity = tr.querySelector('.decNumberBookOrder')

                    btnDecQuantity.setAttribute('data-book-order-id', response.bookOrder.id)

                    btnDecQuantity.id = `decNumber${response.bookOrder.id}`

                    let btnIncQuantity = tr.querySelector('.incNumberBookOrder')

                    btnIncQuantity.setAttribute('data-book-order-id', response.bookOrder.id)

                    btnIncQuantity.id = `incNumber${response.bookOrder.id}`

                    inputNumber.setAttribute('data-book-id', response.bookOrder.id)

                    let bookOrderLimit = tr.querySelector('.bookOrderLimit')

                    bookOrderLimit.innerText = response.bookOrder.books_limit;



                    // inputNumber.setAttribute('data-old-value', bookOrderLimit.innerText)
                }
            })
        });
    })

    //=============================Изменения количества===============================================================

    $(function () {


        $(document).on('change', '.bookOrder', function () {

            let $wrap = $(this).closest('tr');

            let book_quantity = $wrap.find('td input[type="text"].book-quantity')

            book_quantity.val(0);

            book_quantity.attr('data-old-value', 0);



        });
    })

    let changeQuantity = function(quantity, bookId, $wrap,)
    {
        let bookLimitHidden = $wrap.find('td input[type="hidden"].order_book_limit_hidden')

        let bookQuantity = $wrap.find('td input[type="text"].book-quantity')

        // let oldBookNumber = +bookQuantity.attr('data-old-value');

        let $bookLimit = $wrap.find('td.bookOrderLimit');

        let $bookReserve = $wrap.find('td input[type="text"].book-quantity');

        if (+$bookLimit.text() > 0 && quantity > 0 ||+$bookReserve.val() > 1 && quantity < 0)
        {

        let newBookQuantity = +$bookReserve.val()+quantity;

        $bookReserve.val(newBookQuantity);

        $bookLimit.text(+$bookLimit.text().trim()-quantity);

        let oldBookQuantity = bookQuantity.val();

        // console.log(bookQuantity.val())

        +bookQuantity.attr('data-old-value',  oldBookQuantity)

        let count = +$bookLimit.text().trim()

            bookLimitHidden.val(count)
        }

    }

    $(document).on('click',".decNumberBookOrder" , function (e){



        let bookId = $(this).attr('data-book-order-id');

        let $wrap = $(this).closest('tr[data-book-id="' + bookId + '"]');

        changeQuantity (-1, bookId, $wrap,)

        })

    $(document).on('click', ".incNumberBookOrder" ,function (e){





        let bookId = $(this).attr('data-book-order-id');

        let $wrap = $(this).closest('tr[data-book-id="' + bookId + '"]');

            changeQuantity (1, bookId, $wrap,);
        }
    )


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
                city.style.pointerEvents = 'auto';

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
                office.style.pointerEvents = 'auto';

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






























