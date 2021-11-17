@extends('layouts.library')
<meta name="csrf-token" content="{{ csrf_token() }}">
<body class = 'wrapper'>


@section('content')
    <section style="display: flex; flex-wrap:wrap ;height: 750px;background-image: url(https://wwwaxiellcom.cdn.triggerfish.cloud/uploads/2019/03/modern-library.jpg)">
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
                                </tr >
                                </thead>
                                <tbody class="popupBooksInBasket">

{{--                                @dd($booksInBasket)--}}

                                @foreach($booksInBasket as $bookInBasket)

                                <tr class = "data_book_basket_card" id="data_book_basket_card:{{$bookInBasket->id}}" data-book-basket-id = "{{$bookInBasket->id}}">
                                    <td class="garbage_button_container">
                                        <button class="garbage_button" data-book-basket-delete_id ="{{$bookInBasket->id}}"> <img src="/assets/img/garbage_basket.jpeg" class="garbage_basket"></button>

                                    </td>
                                    <td class = "vertical-align">
                                        <div class="flex align-content-center">
                                            <div class="card card_basket" style="width: 2.5rem; height: 4rem;border-radius: 10px;"  >
                                                <div id="carouselExampleControls{{$bookInBasket->id}}" class="carousel slide" data-ride="carousel" data-order-book-id = "{{$bookInBasket->id}}" >
                                                    <div class="carousel-inner" style="width: 2.5rem; height: 4rem;border-radius: 10px">
                                                        @foreach($bookInBasket->images as $image)
                                                            <div class="carousel-item @if($loop->first) active @endif" data-interval="18000">
                                                                <img src="{{asset('/storage/'. $image->images)}}" class="d-block img img_popup" alt="...">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        <div data-added-book-id="{{$bookInBasket->id}}" class ="addedBookContainer">{{$bookInBasket->book_name}}</div></div>
                                    </td >
                                    <td class="bookLimitBasket">
                                        <div class = "quantity_popup_buttons_container">
                                        <button type="button" class="numberBookOrder decPopupBookNumber" style="border: none; background-color: transparent" data-order-book-id ="{{$bookInBasket->id}}">
                                            <img src="https://emojitool.ru/img/apple/ios-14.2/minus-2905.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Minus" >
                                        </button>
                                        <p class = "onlineBookNumber" id="onlineBookNumber:{{$bookInBasket->id}}" data-book-number="{{$bookInBasket->books_number}}">{{$bookInBasket->books_number}}</p>
                                        <button type="button" class="numberBookOrder incPopupBookNumber" style="border: none; background-color: transparent" data-order-book-id ="{{$bookInBasket->id}}">
                                            <img src="https://emojitool.ru/img/apple/ios-14.5/plus-2964.png" style="width: 15px; height: 15px;margin-left: 5px; margin-right: 5px" alt="Plus" >
                                        </button>
                                        </div>
                                    </td>

                                    <td class="bookLimitBasket" id = "bookLimitBasket:{{$bookInBasket->id}}">
                                        {{$bookInBasket->books_limit}}</td>

                                </tr>
                                @endforeach
                                </tbody>
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
        @foreach($books as $book)
        <div class="container"  style="height: 18rem; width: 11.5rem;margin-top: 50px; margin-left: 20px ">

            <div style="width: max-content; height: 20rem; display: flex; position: relative;">
                <div style="display: flex; flex-direction: column;">
                    <a href="{{route('admin.bookOrder', $book)}}">
                    <div class="card" style="width: 11.1rem; height: 16rem;border-radius: 10px;"  >
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
                            <p class="card-text" style="position: absolute; left:5px ; bottom: 0; z-index: 1000;">Осталось книг:{{$book->books_limit}}</p>
                        </div>
                    </div>
                    </a>

                    @if(\Illuminate\Support\Facades\Auth::user()->booksInBasket->contains($book))
                        <a href="" id="basket{{$book->id}}" data-order-book-id = "{{$book->id}}" class = "addToBasket hidden_block"><img src="assets/img/basket_book.png" class = "basket"></a>
                   @endif

                    @if(!(\Illuminate\Support\Facades\Auth::user()->booksInBasket->contains($book)))

                    <a href="" id="basket{{$book->id}}" data-order-book-id = "{{$book->id}}" class = "addToBasket"><img src="assets/img/basket_book.png" class = "basket"></a>
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
        @endforeach
    </section>
{{$books->links()}}



    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>

{{--    @include('includes.main.scripts')--}}
    <script>


        //    ----------------------------------- Замена картинки и изменение счетчика при добавлении в избранное -------------------------------------------------------------

        $(function()
        {
            $(".add_fav_form").on('submit', function(e) {
            e.preventDefault();
            let $this = $(this);
            let url = $this.attr('action');

                $.ajax({
                url: url,
                method: "GET" ,
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},

                success: function(result) {

                    console.log(result)

                    let cartCount = document.getElementById('cartCount');

                    let num = Number(cartCount.innerText)

                    let bookNode = document.getElementById(`favImgId${result.book.id}`)

                    if (result.added)
                    {
                        $(bookNode).attr("src","/assets/img/star.png");

                        num += 1;

                        cartCount.innerText = num;

                        console.log(result.book.id)

                    }
                    else
                    {
                        num -= 1;

                        $(bookNode).attr("src", "http://s1.iconbird.com/ico/2013/6/363/w256h2561372346250Favorite256.png")

                        cartCount.innerText = num;

                        console.log(result.book.id)

                    }
                    },
                });
        })
});
    //    -----------------------------------Модальное окно-------------------------------------------------------------

        const popupLinks = document.querySelectorAll('.popup-link')
        const body = document.querySelector('body')
        const lockPadding = document.querySelectorAll(".lock-padding")

        let unlock = true
        const timeout = 400;

        if(popupLinks.length > 0){
            for(let index = 0; index < popupLinks.length; index++){
                const popupLink = popupLinks[index];
                    popupLink.addEventListener("click", function (e){
                    const currentPopup = document.getElementById('popup')
                    popupOpen(currentPopup);
                    e.preventDefault();
                });
            }
        }

        const popupCloseIcon = document.querySelectorAll('.close-popup')
        if (popupCloseIcon.length > 0){
            for (let index = 0; index <popupCloseIcon.length; index++){
                const el = popupCloseIcon[index];
                el.addEventListener('click', function (e){
                    popupClose(el.closest('.popup'));
                    e.preventDefault();
                });
            }
        }

        function popupOpen(currentPopup){
            if (currentPopup && unlock){
                const popupActive = document.querySelector('.popup.open');
                if(popupActive){
                    popupClose(popupActive, false);
                }else {
                    bodyLock()
                }
                currentPopup.classList.add('open');
                currentPopup.addEventListener('click', function (e){
                    if (!e.target.closest('.popup_content')){
                        popupClose(e.target.closest('.popup'));
                    }
                });
            }
        }

        function popupClose(popupActive, doUnlock = true){

            let data_book_basket_card = document.querySelectorAll('.popupBooksInBasket > .data_book_basket_card');
            let arr = [];
            for(let book of data_book_basket_card) {
                let id = book.getAttribute('data-book-basket-id')
                arr.push(id);
            }

            $.ajax({

                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                url: '/admin/books/book/resetQuantity',
                method: "Post",
                data: {'books_in_basket_id': arr},

                success: function(response){

                }
            })

            if (unlock){
                popupActive.classList.remove('open');
                if(doUnlock){
                    bodyUnlock();
                }
            }
        }

        let btn_basket_return = document.querySelector('.btn_basket_return')
        btn_basket_return.addEventListener('click', function () {
            const popupActive = document.querySelector('.popup.open');
            popupClose(popupActive);
        })

        function bodyLock(){
            // ------------------код для сокрытия скрола модального окна-------------------------------------------------
            const lockPaddingValue = window.innerWidth - document.querySelector('.wrapper').offsetWidth + 'px';
            let index
            for (index = 0; index <lockPadding.length; index++){
                    const el = lockPadding[index];
                    el.style.paddingRight = lockPaddingValue;
            }
            body.style.paddingRight = lockPaddingValue;
            //----------------------------------------------------------------------------------------------------------
            body.classList.add('lock');
            unlock = false;
            setTimeout(function (){
               unlock = true;
            }, timeout);
        }

        function bodyUnlock(){

            setTimeout(function (){
                for (let index = 0; index <lockPadding.length; index++) {
                    const el = lockPadding[index];
                    el.style.paddingRight = '0px';
                }
                body.style.paddingRight = '0px';
                body.classList.remove('lock');
                }, timeout);
            unlock = false;
            setTimeout(function (){
                unlock = true;
            }, timeout);
        }

        document.addEventListener('keydown', function (e) {
            if(e.which === 27){
                const popupActive = document.querySelector('.popup.open');
                popupClose(popupActive);
            }
        });

        //--------------------------------------Добавление в корзину----------------------------------------------------
        $(function (){
            $('.addToBasket').on('click', function (e){
                e.preventDefault();
                let book_id = e.currentTarget.getAttribute('data-order-book-id')
                e.currentTarget.classList.add('hidden_block')

                $.ajax({
                   headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                   method : 'POST',
                   url: '/admin/books/book/addToBasket',
                   data:{'book_id':book_id},

                   success: function (response){

                       let popupBooksInBasket = document.querySelector('.popupBooksInBasket')

                       let tr = document.createElement('tr');
                       popupBooksInBasket.appendChild(tr)
                       tr.classList.add('data_book_basket_card')
                       tr.id = `data_book_basket_card:${response.book_add_to_basket.id}`
                       tr.setAttribute('data-book-basket-id', response.book_add_to_basket.id)

                       let td = document.createElement('td');
                       tr.appendChild(td)
                       td.classList.add('garbage_button_container')

                       let button = document.createElement('button')
                       td.appendChild(button);
                       button.classList.add('garbage_button')


                       button.setAttribute('data-book-basket-delete_id', response.book_add_to_basket.id)

                       let img = document.createElement('img')
                       button.appendChild(img)
                       img.setAttribute('src', "/assets/img/garbage_basket.jpeg")
                       img.classList.add('garbage_basket')

                       let td2 = document.createElement('td');
                       tr.appendChild(td2)

                       let divFlex_td2 = document.createElement('div')
                       td2.appendChild(divFlex_td2)
                       divFlex_td2.classList.add('flex')
                       divFlex_td2.classList.add('align-content-center')

                       let divCard = document.createElement('div')
                       divFlex_td2.appendChild(divCard)
                       divCard.classList.add('card')
                       divCard.classList.add('card_basket')

                       let divBookContainer = document.createElement('div')
                       divFlex_td2.appendChild(divBookContainer)
                       divBookContainer.classList.add('addedBookContainer')
                       divBookContainer.setAttribute('data-added-book-id', response.book_add_to_basket.id)
                       divBookContainer.textContent = response.book_add_to_basket.book_name

                       let divSlide = document.createElement('div')
                       divCard.appendChild(divSlide)
                       divSlide.classList.add('carousel')
                       divSlide.classList.add('slide')

                       let divCarousel = document.createElement('div')
                       divSlide.appendChild(divCarousel)
                       divCarousel.classList.add('carousel-inner')

                       let divCarouselItem = document.createElement('div')
                       divCarousel.appendChild(divCarouselItem)
                       divCarouselItem.classList.add('carousel-item')
                       divCarouselItem.classList.add('active')
                       divCarouselItem.setAttribute('data-interval', '18000')

                       let imgCarousel = document.createElement('img')
                       divCarouselItem.appendChild(imgCarousel)
                       let imgSlide = document.getElementById(`imageId:${response.book_add_to_basket.id}`)
                       let srcImgCarousel = imgSlide.getAttribute('src')
                       imgCarousel.setAttribute('src', srcImgCarousel)
                       imgCarousel.classList.add('img')
                       imgCarousel.classList.add('d-block')
                       imgCarousel.classList.add('img_popup')

                       let td3 = document.createElement('td')
                       tr.appendChild(td3)
                       td3.classList.add('bookLimitBasket')

                       let divPopupButtons = document.createElement('div')
                       td3.appendChild(divPopupButtons)
                       divPopupButtons.classList.add('quantity_popup_buttons_container')

                       let popupButtonDec = document.createElement('button');
                       divPopupButtons.appendChild(popupButtonDec);
                       popupButtonDec.classList.add('numberBookOrder');
                       popupButtonDec.classList.add('decPopupBookNumber');
                       popupButtonDec.setAttribute('data-order-book-id', response.book_add_to_basket.id)
                       popupButtonDec.setAttribute('type', 'button')

                       let imgPopupButton = document.createElement('img')
                       popupButtonDec.appendChild(imgPopupButton)
                       imgPopupButton.setAttribute('src', 'https://emojitool.ru/img/apple/ios-14.2/minus-2905.png')
                       imgPopupButton.classList.add('imgPopupButton')

                       let p_PopupButton = document.createElement('p')
                       divPopupButtons.appendChild(p_PopupButton)
                       p_PopupButton.classList.add('onlineBookNumber')
                       p_PopupButton.id = `onlineBookNumber:${response.book_add_to_basket.id}`
                       p_PopupButton.setAttribute('data-book-number', response.book_add_to_basket.books_number)
                       p_PopupButton.textContent = response.book_add_to_basket.books_number

                       let popupButtonInc = document.createElement('button');
                       divPopupButtons.appendChild(popupButtonInc);
                       popupButtonInc.classList.add('numberBookOrder');
                       popupButtonInc.classList.add('incPopupBookNumber');
                       popupButtonInc.setAttribute('data-order-book-id', response.book_add_to_basket.id)
                       popupButtonInc.setAttribute('type', 'button')

                       let imgPopupButtonInc = document.createElement('img')
                       popupButtonInc.appendChild(imgPopupButtonInc)
                       imgPopupButtonInc.setAttribute('src', 'https://emojitool.ru/img/apple/ios-14.5/plus-2964.png')
                       imgPopupButtonInc.classList.add('imgPopupButton')

                       let td4 = document.createElement('td')
                       tr.appendChild(td4)
                       td4.classList.add('bookLimitBasket')
                       td4.id = `bookLimitBasket:${response.book_add_to_basket.id}`
                       td4.textContent = response.book_add_to_basket.books_limit

                       let decPopupBookNumber = document.querySelectorAll('.quantity_popup_buttons_container > .decPopupBookNumber')
                       for (let decPopupBook of  decPopupBookNumber ){
                           let id = decPopupBook.dataset.orderBookId
                       }
                   }
               })
            })
        })

    //    --------------------------------------Изменение количества------------------------------------------------------------------------


        let changeQuantity = function(quantity, book_id)
        {
            let parentButtons = document.querySelector('.quantity_popup_buttons_container');
            parentButtons.classList.add('disabled')

                $.ajax
                ({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                url :'/admin/books/book/changeQuantity',
                method: "Post" ,
                data:{'book_id': book_id, 'quantity': quantity},

                    success: function (response)
                    {

                    parentButtons.classList.remove('disabled');

                    let onlineBookNumber = document.getElementById(`onlineBookNumber:${response.book.id}`)

                    onlineBookNumber.innerText = response.book.books_number

                    let bookLimitBasket = document.getElementById(`bookLimitBasket:${response.book.id}`)

                    bookLimitBasket.innerText = response.book.books_limit

                    }
                })

        }


        $(document).on('click','.decPopupBookNumber', function (e) {

            let book_id = e.currentTarget.getAttribute('data-order-book-id')

            changeQuantity(-1, book_id)
        })

        $(document).on('click','.incPopupBookNumber', function (e) {

            let book_id = e.currentTarget.getAttribute('data-order-book-id')

            changeQuantity(1, book_id)
        })

        $('.btn_basket_order').on('click',function (e){

            e.preventDefault()

            $.ajax({

                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                url: '/olineLibrary',
                method: "Post",
                data: {'create_order': 'create_order'},

                success: function(){
                }
            })
        })
        //    --------------------------------Удаление----------------------------------------------------------------------

        $(document).on('click', '.garbage_button', function (e){

            let basketCount = document.getElementById('basketCount');
            let count = Number(basketCount.innerText);
            count -= 1;
            basketCount.innerText = count

            let delete_book_id = e.currentTarget.getAttribute('data-book-basket-delete_id');

            $.ajax({

                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                url: '/admin/books/book/deleteFromBasket',
                method: "Post",
                data: {'delete_book_id': delete_book_id},

                    success: function(response){

                        let dataBookBasketCard = document.getElementById(`data_book_basket_card:${response.book_delete_id}`)
                        dataBookBasketCard.remove();
                        let addToBasket = document.getElementById(`basket${response.book_delete_id}`)
                        addToBasket.classList.remove('hidden_block')
                    }
            })
        })

        $('.addToBasket').on('click', function (){

            let basketCount = document.getElementById('basketCount');
            let count = Number(basketCount.innerText);
            console.log(count);
            count += 1;
            basketCount.innerText = count
        })

    </script>


@endsection

</body>



