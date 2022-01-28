<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>


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
            let sumOrder = document.querySelector('.sumOrder')
            sumOrder.style.display = 'block';
            let book_id = e.currentTarget.getAttribute('data-order-book-id')
            e.currentTarget.classList.add('hidden_block')

            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
                method : 'POST',
                url: `/admin/books/book/addToBasket/${book_id}`,
                data:{'book_id':book_id},

                success: function (response){

                    let basketCount = document.getElementById('basketCount');
                    basketCount.innerText = response.number

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
                    p_PopupButton.textContent = 1

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

                    let  td5 = document.createElement('td')
                    tr.appendChild(td5)
                    td5.classList.add('bookLimitBasket', 'bookPriceBasket');
                    td5.id = `bookPriceBasket:${response.book_add_to_basket.id}`;
                    td5.innerText = response.book_add_to_basket.price

                    let td6 = document.createElement('td')
                    tr.appendChild(td6)
                    td6.classList.add('bookLimitBasket', 'bookSumBasket');
                    td6.id = `bookSumBasket:${response.book_add_to_basket.id}`;
                    td6.innerText = response.sum

                    let sumOrder = document.querySelector('.sumOrder')
                    sumOrder.innerText = `Сумма заказа: ${response.sumOrder}`;
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

                onlineBookNumber.innerText = response.number

                let bookLimitBasket = document.getElementById(`bookLimitBasket:${response.book.id}`)

                bookLimitBasket.innerText = response.book.books_limit

                let bookLimit = (document.getElementById(`bookLimit${response.book.id}`))

                bookLimit.innerText = `Осталось книг:${response.book.books_limit}`

                let bookSumBasket = document.getElementById(`bookSumBasket:${response.book.id}`);

                bookSumBasket.innerText = response.number * response.book.price

                let sumOrder = document.querySelector('.sumOrder')

                sumOrder.innerText = `Сумма заказа: ${response.sumOrder}`;

                console.log(sumOrder);
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

        console.log('success');

        let basketCount = document.getElementById('basketCount');
        let count = Number(basketCount.innerText);
        count -= 1;
        basketCount.innerText = count

        let delete_book_id = e.currentTarget.getAttribute('data-book-basket-delete_id');

        console.log(delete_book_id);

        $.ajax({

            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: '/admin/books/book/deleteFromBasket',
            method: "Post",
            data: {'delete_book_id': delete_book_id},

            success: function(response){

                let dataBookBasketCard = document.getElementById(`data_book_basket_card:${response.bookDelete.id}`)
                dataBookBasketCard.remove();
                let addToBasket = document.getElementById(`basket${response.bookDelete.id}`)
                addToBasket.classList.remove('hidden_block')
                let bookLimit = document.getElementById(`bookLimit${response.bookDelete.id}`)
                bookLimit.innerText = `Осталось книг:${response.bookDelete.books_limit}`
                let sumOrder = document.querySelector('.sumOrder')
                sumOrder.textContent = `Сумма заказа: ${response.sumOrder}`;
                if (sumOrder.innerText === 'Сумма заказа: 0')
                {
                    sumOrder.style.display = 'none';
                }

            }
        })
    })


    $(document).ready(function() {

        $('.link_pdf').on('click', function (e){

            e.preventDefault()

            let parentDiv = e.currentTarget.closest('.test');

            let pdfFile = parentDiv.querySelector('.pdfFile')

            let button_pdfFile_close = parentDiv.querySelector('.button_pdfFile_close')

            pdfFile.classList.remove('hidden_block')

            button_pdfFile_close.classList.remove('hidden_block')

            $(button_pdfFile_close).on('click', function (){

                pdfFile.classList.add('hidden_block')

                button_pdfFile_close.classList.add('hidden_block')

            })
        })
    });
</script>
