<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script>


    $('.input-cart-number').on('keyup change', function(){
        let $t = $(this);

        if ($t.val().length > 3) {
            $t.next().focus();
        }

        let card_number = '';
        $('.input-cart-number').each(function(){
            card_number += $(this).val() + ' ';
            if ($(this).val().length === 4) {
                $(this).next().focus();
            }
        })

        $('.credit-card-box .number').html(card_number);
    });

    $('#card-holder').on('keyup change', function(){
        let $t = $(this);
        $('.credit-card-box .card-holder div').html($t.val());
    });

    // $('#card-holder').on('keyup change', function(){
    //     let $t = $(this);
    //     $('.credit-card-box .card-holder div').html($t.val());
    // });

    $('#card-expiration-month, #card-expiration-year').change(function(){
        let m = $('#card-expiration-month option').index($('#card-expiration-month option:selected'));
        m = (m < 10) ? '0' + m : m;
        let y = $('#card-expiration-year').val().substr(2,2);
        $('.card-expiration-date div').html(m + '/' + y);
    })

    $('#card-ccv').on('focus', function(){
        $('.credit-card-box').addClass('hover');
    }).on('blur', function(){
        $('.credit-card-box').removeClass('hover');
    }).on('keyup change', function(){
        $('.ccv div').html($(this).val());
    });

    setTimeout(function(){
        $('#card-ccv').focus().delay(1000).queue(function(){
            $(this).blur().dequeue();
        });
    }, 500);

    //--------------------------------------Pdf show/hide---------------------------------------------------------------


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
