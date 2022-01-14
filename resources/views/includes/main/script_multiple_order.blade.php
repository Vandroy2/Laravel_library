<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>

<script>

    //------------------------------------Изменение количества--------------------------------------------------------------

    let changeQuantity = function(quantity, book_id){
        let parentButtons = document.querySelector('.quantity_buttons_container');
        parentButtons.classList.add('disabled')


        $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url : `/admin/books/book/changeQuantity`,
            method: "Post" ,
            data:{'book_id': book_id, 'quantity': quantity},

            success: function (response)
            {
                parentButtons.classList.remove('disabled');
                let bookNumber = document.getElementById(`bookNumber${response.book.id}`)
                let bookLimit = document.getElementById(`bookLimit${response.book.id}`)
                bookLimit.innerText = response.book.books_limit
                bookNumber.innerText = response.number

            }
        })

    }

    $(".decMultipleOrderNumber").on('click', function (e) {


        let book_id = e.currentTarget.dataset.bookOrderId

        changeQuantity(-1, book_id)

    })

    $(".incMultipleOrderNumber").on('click', function (e){

        let book_id = e.currentTarget.getAttribute('data-book-order-id')

        changeQuantity(1, book_id)

    })


    //------------------------------------Отделения доставки------------------------------------------------------------

$(".delivery").change(function (){

    let delivery_id = document.getElementById('delivery').value

    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: `/admin/cities/show` ,
        data: {'delivery_id': delivery_id},


        success: function (response)
        {
            let city = document.querySelector('.city')
            city.classList.remove('disabled_option')

            let newCities =  response.cities;

            function createOptions(arr) {

                let options = arr.map(function (city){
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

            for (let option of newOptions){
                allCities.appendChild(option);
            }
        }
    })
})


$(".city").change(function (){

    let city_id = document.querySelector('.city').value
    let delivery_id = document.querySelector('.delivery').value

    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: `/offices/show` ,
        data: {'city_id': city_id, 'delivery_id': delivery_id},


        success: function (response)
        {
            let office = document.querySelector('.office')
            office.classList.remove('disabled_option');

            let newOffices =  response.offices;

            function createOptions(arr) {

                let options = arr.map(function (office){
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

            for (let option of newOptions){
                allOffices.appendChild(option);
            }
        }
    })
})



</script>
