<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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

    let ajaxRequest = function (genreId, authorId, sortSales, sortPrice) {

        $.ajax({
            type: 'GET',
            url: '/admin/books/filterBooks',
            data: {'genreId': genreId, 'authorId':authorId, 'sortSales':sortSales, 'sortPrice':sortPrice},

            success:function(response){

                createBookList(response);
            }
        })
    }

    let changeSelect = function (filterType) {

        $(document).on('change', filterType, function (){

            let genre = document.querySelector('.genre');
            let author = document.querySelector('.author');
            let sales = document.querySelector('.sales');
            let price = document.querySelector('.price');

            let genreId = genre.value
            let authorId = author.value
            let sortSales = sales.value
            let sortPrice = price.value

            removeOldBookList('.card_filter, .book_card_container');

            ajaxRequest(genreId, authorId, sortSales, sortPrice)
        });

    }


    $(".clear_buton").click(function(event){
        $(this).closest(".con_img").remove();
    });

    $('.clear_buton').on('click', function(e) {

        e.preventDefault();
        let $this = $(this);
        let url = $this.parent().attr('href');
        console.log(url);
        data = $this.data();

        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function(d) {
                console.log(d);
            },
            error: function(d) {
                console.log(d);
            }
        })
    })



</script>
