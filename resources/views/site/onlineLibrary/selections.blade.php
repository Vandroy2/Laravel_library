@extends('layouts.site.library')

@section('content')
    <section style="display: flex; flex-wrap:wrap ;height: max-content;background-image: url(https://wwwaxiellcom.cdn.triggerfish.cloud/uploads/2019/03/modern-library.jpg)">
        {{----------------------------------------Попап--------------------------------------------}}

        <div class="popup" id="popup">
            <div class="popup_body">
                <div class="popup_content">
                    <a href="" class="popup_close close-popup"><img src="/assets/img/cross.jpeg" class="popup_close_img" alt="close cross"></a>
                    <div class = "popup_title">Корзина</div>
                    <div class="popup_text">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Удалить</th>
                                <th scope="col">Книга</th>
                                <th scope="col">Количество</th>
                                <th scope="col">Осталось книг</th>
                                <th scope="col">Цена</th>
                                <th scope="col">Cумма</th>

                            </tr >
                            </thead>
                            <tbody class="popupBooksInBasket">



                            @foreach($cartBooks as $cartBook)


                                <tr class = "data_book_basket_card" id="data_book_basket_card:{{$cartBook->id}}" data-book-basket-id = "{{$cartBook->id}}">
                                    <td class="garbage_button_container">
                                        <button class="garbage_button" data-book-basket-delete_id ="{{$cartBook->id}}"> <img src="/assets/img/garbage_basket.jpeg" class="garbage_basket"></button>

                                    </td>
                                    <td class = "vertical-align">
                                        <div class="flex align-content-center">
                                            <div class="card card_basket" style="width: 2.5rem; height: 4rem;border-radius: 10px;"  >
                                                <div id="carouselExampleControls{{$cartBook->id}}" class="carousel slide" data-ride="carousel" data-order-book-id = "{{$cartBook->id}}" >
                                                    <div class="carousel-inner" style="width: 2.5rem; height: 4rem;border-radius: 10px">
                                                        @foreach($cartBook->images as $image)
                                                            <div class="carousel-item @if($loop->first) active @endif" data-interval="18000">
                                                                <img src="{{asset('/storage/'. $image->images)}}" class="d-block img img_popup" alt="...">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-added-book-id="{{$cartBook->id}}" class ="addedBookContainer">{{$cartBook->book_name}}</div></div>
                                    </td >
                                    <td class="bookLimitBasket">
                                        <div class = "quantity_popup_buttons_container">
                                            <button type="button" class="numberBookOrder decPopupBookNumber" style="border: none; background-color: transparent" data-order-book-id ="{{$cartBook->id}}">
                                                <img src="https://emojitool.ru/img/apple/ios-14.2/minus-2905.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Minus" >
                                            </button>
                                            <p class = "onlineBookNumber" id="onlineBookNumber:{{$cartBook->id}}" data-book-number="{{$cartBook->books_number}}">{{Session::get('cartBooks')[$cartBook->id]['count']}}</p>
                                            <button type="button" class="numberBookOrder incPopupBookNumber" style="border: none; background-color: transparent" data-order-book-id ="{{$cartBook->id}}">
                                                <img src="https://emojitool.ru/img/apple/ios-14.5/plus-2964.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Plus" >
                                            </button>
                                        </div>
                                    </td>

                                    <td class="bookLimitBasket" id = "bookLimitBasket:{{$cartBook->id}}">
                                        {{$cartBook->books_limit}}</td>

                                    <td class="bookPriceBasket bookLimitBasket" id = "bookPriceBasket:{{$cartBook->id}}">
                                        {{$cartBook->price}}

                                    </td>
                                    <td class="bookSumBasket bookLimitBasket" id = "bookSumBasket:{{$cartBook->id}}">
                                        {{$cartBook->price * Session::get('cartBooks')[$cartBook->id]['count']}}

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                            <tfoot>
                            <td colspan="6">
                                <div class = "sumOrder">Сумма заказа:  {{$sumOrder}}</div>
                            </td>
                            </tfoot>


                        </table>
                        <table>

                        </table>

                    </div>
                    <div class = "flex buttons_basket_footer_container">
                        <button class = "btn btn-primary btn_basket_return btn_basket_height">Вернуться в библиотеку</button>

                        <form method="post" action="{{route('admin.bookMultipleOrder')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                            <button class = "btn btn-primary btn_basket_return btn_basket_height">Оформить заказ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>


    @foreach($selections as $selection)

        <div class="top_select_text">{{$selection->selection_name}}</div>

        <section style="display: flex; flex-wrap:wrap ;height: max-content;background-image: url(https://wwwaxiellcom.cdn.triggerfish.cloud/uploads/2019/03/modern-library.jpg)">

            <div style="margin-left: -10px; padding: 10px" class="flex">

                @foreach($selection->books as $book)
                @if($book->books_limit > 0)
                    <div class="container"  style="height: 18rem; width: 11.5rem;margin-top: 50px; margin-left: 10px ">

                        <div style="width: max-content; height: 20rem; display: flex; position: relative;">
                            <div style="display: flex; flex-direction: column;">
                                <a href="{{route('admin.bookOrder', $book)}}">
                                    <div class="card" style="width: 11.1rem; height: 17rem;border-radius: 10px;"  >
                                        <div id="carouselExampleControls{{$book->id}}" class="carousel slide" data-ride="carousel" data-order-book-id = "{{$book->id}}" >
                                            <div class="carousel-inner" style="width: 11rem; height: 9rem;border-radius: 10px">
                                                @foreach($book->images as $image)
                                                    <div class="carousel-item @if($loop->first) active @endif" data-interval="18000">
                                                        <img src="{{asset('/storage/'. $image->images)}}" class="d-block img img_slide" alt="..." id = "imageId:{{$book->id}}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls{{$book->id}}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Prev</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls{{$book->id}}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title">{{$book->book_name}}</h6>
                                            <p class="card-text">{{$book->author->fullname}}</p>
                                            <p class="card-text" id = "bookLimit{{$book->id}}" style="position: absolute; left:5px ; bottom: 0; z-index: 1000;">Осталось книг:{{$book->books_limit}}</p>
                                            <p class="card-text" style="position: absolute; left:5px ; bottom: 0; z-index: 1000;">Цена:{{$book->price}}</p>
                                        </div>
                                    </div>
                                </a>

                                @if($book->genre)

                                    <div class="genre_block">
                                        {{$book->genre->genre_name}}
                                    </div>

                                @endif



                                @if($cartBooks->contains($book))
                                    <a href="" id="basket{{$book->id}}" data-order-book-id = "{{$book->id}}" class = "addToBasket hidden_block"><img src="assets/img/basket_book.png" class = "basket card_selection"></a>
                                @endif
                                @if(!$cartBooks->contains($book))
                                    <a href="" id="basket{{$book->id}}" data-order-book-id = "{{$book->id}}" class = "addToBasket"><img src="/assets/img/basket_book.png" class = "basket card_selection"></a>
                                @endif

                                <form action="{{route('onLineLibraryAddToFavorite', ['book' => $book])}}" class="add_fav_form" method ="POST" style="margin-bottom: 5px ; margin-top: 10px; position: absolute; left: 0; top: -10px; z-index: 1000;">
                                    @csrf
                                    <button type="submit" class="border-0 bg-transparent btn-ens-action btn-ens-style " data-rel="4a9f99dc105">
                                        @auth()
                                            @if(\Illuminate\Support\Facades\Auth::user()->books->contains($book))
                                                <img src="/assets/img/star.png" alt="Remove" class="clear_buton" id="favImgId{{$book->id}}" title="Добавить в избранное" width="25" height="25">
                                            @else
                                                <img src="http://s1.iconbird.com/ico/2013/6/363/w256h2561372346250Favorite256.png" alt="Remove" class="clear_buton" id="favImgId{{$book->id}}" title="Удалить из избранного" width="25" height="25"/>
                                            @endif
                                        @endauth


                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            </div>
        </section>
    @endforeach



    @include('includes.main.functions')


@endsection


