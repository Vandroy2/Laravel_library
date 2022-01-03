@include('includes.admin.scripts')

<script>

    let createBookElement =  function (arr, mainElement, createItemType, text)
    {
        let element

        element = document.createElement(createItemType)

        mainElement.appendChild(element)

        if(arr.length !== 0)
        {
            arr.forEach(function (item){
                element.classList.add(item)
            })
        }

        if(text){
            element.innerText = text;
        }
        return element
    }

    const removeOldBookList = function (selectorName)
    {
        $(selectorName).remove();
    }

    let createBookList = function(response){

            response.books.forEach(function (book){

                let text = null

                let book_selection = document.querySelector('.book_selection')

                let book_container = createBookElement(['book_card_container'], book_selection, 'div')

                let cardFilter = createBookElement(['card', 'card_filter', 'margin_filter'], book_container, 'div', text)

                let divSlide = createBookElement(['carousel', 'slide'], cardFilter, 'div', text)

                let divCarousel = createBookElement([], divSlide, 'div', text)

                let divCarouselItem = createBookElement(['carousel-item','active'], divCarousel, 'div', text)

                let imgCarousel = createBookElement(['img', 'd-block', 'img_slide_filter'], divCarouselItem, 'img', text)

                imgCarousel.setAttribute('src', `http://library.loc/storage/${book.images[0].images}`)

                let cardBody = createBookElement(['card-body'], cardFilter, 'div', text)

                let textCardTitle = book.book_name
                createBookElement(['card-title'], cardBody, 'h6', textCardTitle)

                let textCardAuthor = `${book.author.author_name} ${book.author.author_surname}`
                createBookElement(['card-text'], cardBody, 'p', textCardAuthor)

                let textCardPrice = `Цена :${book.price}`
                createBookElement(['card-text'], cardBody, 'p', textCardPrice)
            })



    }

    let ajaxRequest = function (url, data) {
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: url,
            data: data,

            success:function(response){

                createBookList(response);
            }
        })
    }

    let changeSelect = function (filterType, urlSelect){

        $(document).on('change', filterType, function (e){

            removeOldBookList('.card_filter, .book_card_container');

            let dataSend = e.currentTarget.value

            let url = urlSelect

            let data = {'data': dataSend}

            ajaxRequest(url, data)
        });

    }



</script>
