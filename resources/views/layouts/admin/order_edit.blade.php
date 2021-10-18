@include('includes.admin.head')

<body style="margin-left: 15px">
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')



<form action="{{route('admin.orderUpdate', $order)}}" method = "Post" enctype="multipart/form-data" >

    @csrf

    <div class="form-group">
        <h6>Номер заказа</h6>
        <h6>{{$order->id}}</h6>

    </div>


    <div class="form-group">
        <h6>Служба доставки</h6>
        <select class="admin delivery" name="delivery_id" >
            <option value="{{$order->delivery->id}}" ><label >{{$order->delivery->delivery_name}}</label></option>
            @foreach($deliveries as $delivery)
                <option value="{{$delivery->id}}" class="option" name="delivery_id">{{$delivery->delivery_name}}</option>

            @endforeach
        </select>
    </div>

    <div class="form-group" >
        <h6>Номер отделения</h6>
        <select class="admin office" name="office_id">
            <option value="{{$order->office->id}}" ><label class="admin_label" >{{$order->office->office_number}}</label></option>

            @foreach($offices as $office)
                <option value="{{$office->id}}" class="option" >{{$office->office_number}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <h6>Название книги</h6>
        <select class="admin office" name="book_id" >
            <option value="{{$bookOrder->id}}"><label class="admin_label" >{{$bookOrder->book_name}}</label></option>

            @foreach($books as $book)
                <option value="{{$book->id}}" class="option" >{{$book->book_name}}</option>
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
        <select class="admin office" name="status_id">
            <option value="{{$order->status->id}}"><label class="admin_label" >{{$order->status->status}}</label></option>
            @foreach($status as $stat)

                <option value="{{$stat->id}}" class="option" >{{$stat->status}}</option>

            @endforeach
        </select>
    </div>


    <div class="form-group">
        <h6>Выберите количество книг</h6>
        <div class = "book_number number" style="display: flex">
            <a href="{{route('bookOrderdecNumber', $bookOrder)}}" class = "numberHref"><img src="https://emojitool.ru/img/apple/ios-14.2/minus-2905.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Minus" id="decbookNumber"></a>
            <p class = "number_2" id="number_2" data-book-number="{{$bookOrder->books_number}}">{{$bookOrder->books_number}}</p>
            <a href="{{route('bookOrderincNumber', $bookOrder)}}" class = "numberHref"><img src="https://emojitool.ru/img/apple/ios-14.5/plus-2964.png" style="width: 15px; height: 15px; margin-left: 5px" alt="Plus" id="incbookNumber"></a>
        </div>
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

    $(function()
    {
        $("#decbookNumber").on('click', function (e){

            e.preventDefault()

            let $this = $(this)

            let url = $this.parent().attr('href')


            $.ajax({

                url : url,
                method: "GET" ,

                success: function ()
                {

                    let number_2 = document.getElementById('number_2')

                    let num = number_2.innerText

                    if (num > 1){

                        num -=1

                        number_2.innerText = num

                        // console.log(num)
                    }


                }

            })

        })


    })

    $(function()
    {
        $("#incbookNumber").on('click', function (e){

            e.preventDefault()

            let $this = $(this)

            let url = $this.parent().attr('href')


            $.ajax({

                url : url,
                method: "GET" ,

                success: function (response)
                {
                    let number_2 = document.getElementById('number_2')

                    let num = Number(number_2.innerText)

                    if (num < response.book.books_limit){

                        num +=1

                        number_2.innerText = num

                        // console.log(num)
                    }
                }
            })
        })
    })



    // $(function (){
    //
    //     $(".delivery").change(function (){
    //
    //         let form = document.getElementById('bookOrderForm')
    //         let id = form.getAttribute('data-book-order-id')
    //         let delivery_id = document.getElementById('delivery').value
    //
    //
    //
    //         $.ajax({
    //             type: 'POST',
    //             headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
    //             url: `/bookOrder/${id}` ,
    //             data: {'delivery_id': delivery_id},
    //
    //
    //
    //             success: function (response)
    //             {
    //                 let newOffices =  response.offices;
    //
    //                 function createOptions(arr) {
    //
    //                     let options = arr.map(function (office){
    //                         let option = document.createElement('option');
    //                         option.value = office.office_number
    //                         option.innerText = `№ ${office.office_number} some address`
    //                         return option
    //                     })
    //                     let option = document.createElement('option');
    //                     option.innerText = 'Отделение'
    //                     options.unshift(option)
    //                     return options;
    //                 }
    //
    //                 let allOffices = document.getElementById('offices')
    //
    //                 while (allOffices.firstChild) {
    //                     allOffices.removeChild(allOffices.firstChild);
    //                 }
    //
    //                 let newOptions = createOptions(newOffices)
    //
    //                 for (let option of newOptions){
    //                     allOffices.appendChild(option);
    //                 }
    //             }
    //         })
    //     })
    // })
        </script>





















