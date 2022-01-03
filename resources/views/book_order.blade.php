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

                <select required class="admin delivery " id="delivery" name="delivery_id" >
                    <option value=""><label >Служба доставки</label></option>
                    @foreach($deliveries as $delivery)
                    <option value="{{$delivery->id}}" class="option" id="option_book" name="delivery_id">{{$delivery->delivery_name}}</option>

                    @endforeach
                </select>
            </td>

            <tr>
            <th scope="row">Выберите Город</th>
            <td class = "table_row">

                <select required class="admin city disabled_option" name="city_id" id="city">
                    <option value=""><label >Город</label></option>
                    @foreach($cities as $city)
                    <option value="{{$city->id}}" name="ukrcity_id" >{{$city->city_name}}</option>
                    @endforeach
                </select>

            </td>

        </tr>
        <tr>
            <th scope="row">Выберите отделение</th>
            <td colspan="2" class = "table_row">

                <select required class="admin office disabled_option" name="office_id" id="office">
                    <option value=""><label >Отделение</label></option>
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
                    <div class = "book_number" >
                    <p>Осталось книг в наличии</p>
                    <p style="margin-left: 20px" data-book-limit="{{$bookOrder->books_limit}}" id="bookLimit">{{$bookOrder->books_limit}}</p>
                    </div>
                    <div class = "book_number" >
                        <p>Цена</p>
                        <p style="margin-left: 20px" data-book-limit="{{$bookOrder->price}}" id="bookLimit">{{$bookOrder->price}}</p>
                    </div>
                    <div class = "book_number" >
                    <div>Сумма заказа:</div>
                        <div class = "book_order_sum">{{$sum}}</div>
                    </div>
                </div>
            </th>
            <td colspan="2" class = "table_row">
                <div class = "quantity_buttons_container number ">
                    <button type="button" class="numberBookOrder " style="border: none;  background-color: transparent" id="decBookNumber">
                        <img src="https://emojitool.ru/img/apple/ios-14.2/minus-2905.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Minus" >
                    </button>
                    <p class = "bookNumber" id="bookNumber" data-book-number="{{$bookOrder->books_number}}">{{$bookOrder->books_number}}</p>
                    <button type="button" class="numberBookOrder" style="border: none;background-color: transparent" id="incBookNumber">
                        <img src="https://emojitool.ru/img/apple/ios-14.5/plus-2964.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Minus" >
                    </button>

                </div>

            </td>

        </tr>
        </tbody>

    </table>
        <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
        <input type="hidden" name="booksOrder[]" value="{{$bookOrder->id}}">
        <button type="submit" class = 'btn btn-secondary btn_book_order'>Оформить заказ</button>
    </form>

</section>

@include('includes.main.scripts')

</body>
