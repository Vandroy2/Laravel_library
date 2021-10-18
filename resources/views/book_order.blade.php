@include('includes.main.head')
@include('includes.main.personalNav')
@include('includes.errors')
@include('includes.admin.scripts')
<meta name="csrf-token" content="{{ csrf_token() }}">

<body >

<section style="height: 100vh;display: flex; background-image: url(https://img5.goodfon.ru/original/1920x1200/9/81/korabl-sudno-gory-skaly-vodoem-ford-zaliv-norvegiia-oblaka-o.jpg)" >

    <div style="width: max-content; height: 20rem; display: flex; position: relative">

                <div style="display: flex; flex-direction: column;">

                    <div class="card book_card" style="width: 23rem; height: 38rem;border-radius: 10px">
                        <div id="carouselExampleControls{{$bookOrder->id}}" class="carousel slide" data-ride="carousel" >
                            <div class="carousel-inner" style="width: 23rem; height: 30rem;border-radius: 10px">
                                @foreach($bookOrder->images as $image)
                                    <div class="carousel-item @if($loop->first) active @endif" data-interval="18000">
                                        <img src="{{asset('/storage/'. $image->images)}}" class="d-block img" style="width: 23rem; height: 30rem;border-radius: 5px" alt="...">
                                    </div>
                                @endforeach

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls{{$bookOrder->id}}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Prev</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls{{$bookOrder->id}}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">{{$bookOrder->book_name}}</h6>
                            <p class="card-text">{{$bookOrder->author->fullname}}</p>

                        </div>
                    </div>
                </div>
            </div>
    <form action="{{route('admin.orderCreate')}}" method="POST" data-book-order-id="{{$bookOrder->id}}" id="bookOrderForm">
        @csrf
        <table class="table table-bordered table-secondary order_table">

            <tbody class ="order_table">

            <th scope="row">Выберите службу доставки</th>
            <td class = "table_row">

                <select class="admin delivery" id="delivery" name="delivery_id" >
                    <option value="delivery"><label >Служба доставки</label></option>
                    @foreach($deliveries as $delivery)
                    <option value="{{$delivery->id}}" class="option" name="delivery_id">{{$delivery->delivery_name}}</option>

                    @endforeach
                </select>

            </td>


        <tr>
            <th scope="row">Выберите Город</th>
            <td class = "table_row">

                <select class="admin" name="ukrcity_id" >
                    <option value="ukrcity"><label >Город</label></option>
                    @foreach($ukrcities as $ukrcity)
                    <option value="{{$ukrcity->id}}" name="ukrcity_id" >{{$ukrcity->ukrcity_name}}</option>
                    @endforeach
                </select>

            </td>

        </tr>
        <tr>
            <th scope="row">Выберите отделение</th>
            <td colspan="2" class = "table_row">

                <select class="admin office" name="office_id" id="offices">
                    <option value="office"><label >Отделение</label></option>
                    @foreach($offices as $office)
                        <option value="{{$office->id}}" class="option" >{{$office->office_number}}</option>

                    @endforeach
                </select>

            </td>
        </tr>
        <tr>
            <th scope="row">
                <div>
               <p>Выберите количество</p>
                    <div class = "book_number ">
                    <p>Всего книг в наличии</p>
                    <p style="margin-left: 20px">{{$bookOrder->books_limit}}</p>
                    </div>
                </div>
            </th>
            <td colspan="2" class = "table_row">
                <div class = "book_number number">
                    <a href="{{route('bookOrderdecNumber', $bookOrder)}}" class = "numberHref"><img src="https://emojitool.ru/img/apple/ios-14.2/minus-2905.png" style="width: 15px; height: 15px" alt="Minus" id="decbookNumber"></a>
                    <p class = "number_2" id="number_2" data-book-number="{{$bookOrder->books_number}}">{{$bookOrder->books_number}}</p>
                    <a href="{{route('bookOrderincNumber', $bookOrder)}}" class = "numberHref"><img src="https://emojitool.ru/img/apple/ios-14.5/plus-2964.png" style="width: 15px; height: 15px" alt="Plus" id="incbookNumber"></a>
                </div>
            </td>

        </tr>
        </tbody>

    </table>

        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
        <input type="hidden" name="book_id" value="{{$bookOrder->id}}">

        <button type="submit" class = 'btn btn-secondary btn_book_order'>Оформить заказ</button>
    </form>

</section>

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


    $(function (){
        // debugger
        $('#bookOrderForm').on('submit', function (e){
            // e.preventDefault()
            let number_2 = document.getElementById('number_2')
            let $this = $(this)
            let url = $this.attr('action')
            let books_number = number_2.dataset.bookNumber
            console.log(books_number)
            // console.log({'books_number': books_number},)
            $.ajax({

                type: 'POST',
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                url: url ,
                data: {'books_number': books_number},

                success:function (response)
                {
                   console.log(response)
                }

            })
        })
    })

    $(function (){

$(".delivery").change(function (){

    let form = document.getElementById('bookOrderForm')
    let id = form.getAttribute('data-book-order-id')
    let delivery_id = document.getElementById('delivery').value



    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: `/bookOrder/${id}` ,
        data: {'delivery_id': delivery_id},



        success: function (response)
        {
            let newOffices =  response.offices;

            function createOptions(arr) {

                let options = arr.map(function (office){
                    let option = document.createElement('option');
                    option.value = office.office_number
                    option.innerText = `№ ${office.office_number} some address`
                    return option
                })
                let option = document.createElement('option');
                option.innerText = 'Отделение'
                options.unshift(option)
                return options;
            }

           let allOffices = document.getElementById('offices')

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
    })




</script>

</body>
