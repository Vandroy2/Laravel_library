{{------------------------------------------------Подключение Jquery--------------------------------------------------}}
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>

{{--------------------------------------BookOrder---------------------------------------------------------------------}}

<script>

    //---------------------------------------Отделения доставки-------------------------------------------------------

    $(".delivery").change(function (){

        let delivery_id = document.getElementById('delivery').value

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: `/admin/cities/show` ,
            data: {'delivery_id': delivery_id},


            success: function (response)
            {
                let city = document.getElementById('city')
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

                let allCities = document.getElementById('city')

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

        let city_id = document.getElementById('city').value
        let delivery_id = document.getElementById('delivery').value

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: `/offices/show` ,
            data: {'city_id': city_id, 'delivery_id': delivery_id},


            success: function (response)
            {
                let office = document.getElementById('office')
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

                let allOffices = document.getElementById('office')

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

//    ---------------------------------Изменение количества-------------------------------------------------------------


    let changeQuantity = function(quantity){
        let parentButtons = document.querySelector('.quantity_buttons_container');
        parentButtons.classList.add('disabled')
        let form = document.getElementById('bookOrderForm');
        let book_id = form.getAttribute('data-book-order-id');



        $.ajax({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url : `/admin/books/book/changeQuantity`,
            method: "Post" ,
            data:{'book_id': book_id, 'quantity': quantity},

            success: function (response)
            {
                console.log(response)

                parentButtons.classList.remove('disabled');
                let bookNumber = document.getElementById('bookNumber')
                let bookLimit = document.getElementById('bookLimit')
                bookLimit.innerText = response.book.books_limit
                bookNumber.innerText = response.number
                let bookOrderSum = document.querySelector('.book_order_sum')
                bookOrderSum.innerText = `Сумма заказа: ${response.sumOrder}`

            }
        })

    }

    $("#decBookNumber").on('click', function () {
        changeQuantity(-1)
    })

    $("#incBookNumber").on('click', function (){
        changeQuantity(1)
    })


    $('#bookOrderForm').on('submit', function (){

        let bookNumber = document.getElementById('bookNumber')
        let $this = $(this)
        let url = $this.attr('action')
        let books_number = bookNumber.dataset.bookNumber
        console.log(books_number)

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


{{-------------------------------------------------Personal cabinet---------------------------------------------------}}




    function sendMarkRequest(id=null) {
    return $.ajax
    (
    "{{route('markNotifications')}}",
    {
    headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
    method:"POST",
    data: { 'id':id}

    }
    );
    }

    $(function (){
    $('.mark-as-read').click
    (
    function ()
    {let request = sendMarkRequest($(this).data('id'));
    request.done
    (() => {
    $(this).parents('div.alert').remove();
    });
    });
    $('#mark-all').click(function (){

    let request = sendMarkRequest();

    request.done(() => {
    $('div.alert').remove();
    $('#mark-all').remove();
    })
    })
    });



</script>
