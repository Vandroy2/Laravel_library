@extends('layouts.site.personalCabinet')

@section('content')

    <form class="form" action="{{route('subscribeSale')}}" method="POST">
        @csrf

    <div class="admin_index_container">

        @include('includes.errors')

        <div class="secondary_container flex w-100 justify-content-center">


            <section class="payment_text">

                @if($listOfSubscribe->listSubscribeType == 'Premium')
            <h4 class="text-center">Стоимость премиум подписки составляет {{$listOfSubscribe->listSubscribePrice}} грн в месяц</h4>
            <h6 class="text-center">После оплаты все книги представленные в библиотеке станут доступны для чтения и прослушивания</h6>
            @endif



                @if($listOfSubscribe->listSubscribeType == 'Authors')
                    <h4 class="text-center">Стоимость подписки на трех выбранных авторов составляет {{$listOfSubscribe->listSubscribePrice}} грн в месяц</h4>
                    <h6 class="text-center">После оплаты все книги выбранных авторов станут доступны для чтения и прослушивания</h6>

                        <div class="form-group">

                            <div class = genre_text>
                                Выберите 3 автора
                            </div>

                            <select class="admin genre payment_select" name="authors_id[]" required multiple>
                                @foreach($authors as $author)
                                    <option value="{{$author->id}}" name="author_id">{{$author->fullname}}</option>
                                @endforeach
                            </select>

                        </div>
                    <input type="hidden" name="listSubscribe_type" value="{{$listOfSubscribe->listSubscribeType}}">

                @endif

                    @if($listOfSubscribe->listSubscribeType == 'Genre')
                        <h4 class="text-center">Стоимость подписки на два жанра составляет {{$listOfSubscribe->listSubscribePrice}} грн в месяц</h4>
                        <h6 class="text-center">После оплаты все книги выбранных жанров станут доступны для чтения и прослушивания</h6>

                        <div class="form-group">

                            <div class = genre_text>
                                Выберите 2 жанра
                            </div>

                            <select class="admin genre payment_select" name="genres_id[]" required multiple>

                                @foreach($genres as $genre)
                                    <option value="{{$genre->id}}">{{$genre->genre_name}}</option>
                                @endforeach
                            </select>

                        </div>
                        <input type="hidden" name="genres" value="{{$listOfSubscribe->listSubscribeType}}">

                    @endif

                    @if($listOfSubscribe->listSubscribeType == 'New')
                        <h4 class="text-center">Стоимость подписки на ранний доступ к новинкам составляет {{$listOfSubscribe->listSubscribePrice}} грн в месяц</h4>
                        <h6 class="text-center">После оплаты будет предоставлен ранний доступ к аудио и PDF файлам новинок, представленных в библиотеке</h6>
                    @endif
            </section>


            <section class="payment_form">
                <div class="checkout">
                    <div class="credit-card-box">
                        <div class="flip">
                            <div class="front">
                                <div class="chip"></div>
                                <div class="logo">
                                    <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                                        <g>
                                            <g>
                                                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                         c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                         c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                         M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                         c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                         c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                         l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                         C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                         C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                         c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                         h-3.888L19.153,16.8z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="number"></div>
                                <div class="card-holder">
                                    <label>Card holder</label>
                                    <div></div>
                                </div>
                                <div class="card-expiration-date">
                                    <label>Expires</label>
                                    <div></div>
                                </div>
                            </div>
                            <div class="back">
                                <div class="strip"></div>
                                <div class="logo">
                                    <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                                        <g>
                                            <g>
                                                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                         c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                         c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                         M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                         c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                         c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                         l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                         C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                         C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                         c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                         h-3.888L19.153,16.8z" />
                                            </g>
                                        </g>
                                    </svg>

                                </div>
                                <div class="ccv">
                                    <label>CCV</label>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->cart_number)
                    @else

                    <fieldset>
                        <label for="card-number">Card Number</label>
                        <input type="number" id="card-number" class="input-cart-number" maxlength="4" name="cartNumber1"/>
                        <input type="number" id="card-number-1" class="input-cart-number" maxlength="4" name="cartNumber2"/>
                        <input type="number" id="card-number-2" class="input-cart-number" maxlength="4" name="cartNumber3"/>
                        <input type="number" id="card-number-3" class="input-cart-number" maxlength="4" name="cartNumber4"/>
                    </fieldset>
                    <fieldset>
                        <label for="card-holder">Card holder</label>
                        <input type="text" id="card-holder" name="name"/>
                    </fieldset>
                    <fieldset class="fieldset-expiration">
                        <label for="card-expiration-month">Expiration date</label>
                        <div class="select">
                            <select id="card-expiration-month" name = "month">
                                <option></option>
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                            </select>
                        </div>
                        <div class="select">
                            <select id="card-expiration-year" name="year">
                                <option></option>
                                <option>2016</option>
                                <option>2017</option>
                                <option>2018</option>
                                <option>2019</option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="fieldset-ccv">
                        <label for="card-ccv">CCV</label>

                        <input type="text" id="card-ccv" maxlength="3" name="card_ccv"/>

                    </fieldset>
                    @endif

                    <h5 style="margin-top: 100px" >Сумма к оплате: {{$listOfSubscribe->listSubscribePrice}}грн.</h5>

                    <button class="btn"><i class="fa fa-lock"></i> Оплатить подписку</button>
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="listSubscribe_id" value="{{$listOfSubscribe->id}}">
                    <input type="hidden" name="listSubscribePrice" value="{{$listOfSubscribe->listSubscribePrice}}">
                    <input type="hidden" name="balance" value="{{Auth::user()->balance}}">

                </div>

                <a class="the-most" target="_blank" href="https://codepen.io/2016/popular/pens/9/">
                    <img src="https://raw.githubusercontent.com/supahfunk/supah-codepen/master/themost-2016.png">
                </a>
            </section>
        </div>

    </div>


    </form>

   @include('includes.admin.functions')

@endsection
