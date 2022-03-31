<?php
/**
 * @var ListOfSubscribe $listOfSubscribe
 */

use App\Models\ListOfSubscribe;

?>

@extends('layouts.site.personalCabinet')

@section('content')

    <div class="admin_index_container subscribe_index_container">

        @include('includes.errors')

        <div class="secondary_container">

{{--            <h2 class = "text-center" >Подписки</h2>--}}
            <div class="main_logo_container text-center">
                <img src="/assets/img/subscribe.png" class="main_logo" alt="Premium">
            </div>
            <section class="flex flex-wrap">




<div class="main_subscribe_container">
    <div class="subscribe_title">
        <h3 class="subscribe_text_title">Премиум</h3>
    </div>

            <div class="secondary_subscribe_container">


                @foreach($listOfSubscribes as $listOfSubscribe)
                    @if($listOfSubscribe->listSubscribeType == 'Premium')
                        <div class = "flex-column subscribe_premium_container">
                            <div class="duration_container duration">
                                <h4 class = "price">{{$listOfSubscribe->duration}}</h4>
                            </div>
                            <div class="premium_logo_container">
                                <img src="/assets/img/premium.png" class="premium_logo" alt="Premium">
                            </div>

                            <div class="flex subscribe_text_container">
                                <img src="/assets/img/check.png" class="check_logo" alt="logo">
                                <p>Доступ ко всем аудио книгам</p>
                            </div >
                            <div class="flex subscribe_text_container">
                                <img src="/assets/img/check.png" class="check_logo" alt="logo">
                                <p>Доступ ко всем книгам в PDF формате</p>
                            </div>
                            @if($listOfSubscribe->checkAffiliation())
                                <h4 class="subscribed">Подписка оформлена</h4>
                            @else
                            <a href="{{route('payment', $listOfSubscribe)}}" class="link_price"><div class="duration_container price_container">
                                <h4 class="price">Оплатить {{$listOfSubscribe->listSubscribePrice}}грн</h4>
                                </div></a>
                            @endif
                        </div>
                    @endIf
                    @endforeach
            </div>
</div>




            <div class="main_subscribe_container">
                <div class="subscribe_title">
                    <h3 class="subscribe_text_title">Авторы</h3>
                </div>

                <div class="secondary_subscribe_container">


                    @foreach($listOfSubscribes as $listOfSubscribe)
                        @if($listOfSubscribe->listSubscribeType == 'Authors')
                            <div class = "flex-column subscribe_premium_container subscribe_author_container">
                                <div class="duration_container duration duration_author">
                                    <h4 class = "price">{{$listOfSubscribe->duration}}</h4>
                                </div>
                                <div class="premium_logo_container author_logo_container">
                                    <img src="/assets/img/author.png" class="premium_logo" alt="Premium">
                                </div>

                                <div class="flex subscribe_text_container">
                                    <img src="/assets/img/check.png" class="check_logo" alt="logo">
                                    <p>Доступ ко всем аудио книгам трех любимых авторов</p>
                                </div >
                                <div class="flex subscribe_text_container">
                                    <img src="/assets/img/check.png" class="check_logo" alt="logo">
                                    <p>Доступ ко всем книгам в PDF формате трех любимых авторов</p>
                                </div>

                                @if($listOfSubscribe->checkAffiliation())
                                    <h4 class="subscribed">Подписка оформлена</h4>
                                @else
                                <a href="{{route('payment', $listOfSubscribe)}}" class="link_price"><div class="duration_container price_container">
                                        <h4 class="price">Оплатить {{$listOfSubscribe->listSubscribePrice}}грн</h4>
                                    </div></a>
                                @endif
                            </div>
                        @endIf
                    @endforeach
                </div>
            </div>

            <div class="main_subscribe_container">
                <div class="subscribe_title">
                    <h3 class="subscribe_text_title">Жанры</h3>
                </div>

                <div class="secondary_subscribe_container">


                    @foreach($listOfSubscribes as $listOfSubscribe)
                        @if($listOfSubscribe->listSubscribeType == 'Genre')
                            <div class = "flex-column subscribe_premium_container subscribe_genre_container">
                                <div class="duration_container duration duration_genre">
                                    <h4 class = "price">{{$listOfSubscribe->duration}}</h4>
                                </div>
                                <div class="premium_logo_container genre_logo_container">
                                    <img src="/assets/img/genre.png" class="premium_logo" alt="Premium">
                                </div>

                                <div class="flex subscribe_text_container">
                                    <img src="/assets/img/check.png" class="check_logo" alt="logo">
                                    <p>Доступ ко всем аудио книгам трех любимых жанров</p>
                                </div >
                                <div class="flex subscribe_text_container">
                                    <img src="/assets/img/check.png" class="check_logo" alt="logo">
                                    <p>Доступ ко всем книгам в PDF формате трех любимых жанров</p>
                                </div>
                                @if($listOfSubscribe->checkAffiliation())
                                    <h4 class="subscribed">Подписка оформлена</h4>
                                @else
                                <a href="{{route('payment', $listOfSubscribe)}}" class="link_price"><div class="duration_container price_container">
                                        <h4 class="price">Оплатить {{$listOfSubscribe->listSubscribePrice}}грн</h4>
                                    </div></a>
                                @endif
                            </div>
                        @endIf
                    @endforeach
                </div>
            </div>

            <div class="main_subscribe_container">
                <div class="subscribe_title">
                    <h3 class="subscribe_text_title">Новинки</h3>
                </div>

                <div class="secondary_subscribe_container">


                    @foreach($listOfSubscribes as $listOfSubscribe)
                        @if($listOfSubscribe->listSubscribeType == 'New')
                            <div class = "flex-column subscribe_premium_container subscribe_new_container">
                                <div class="duration_container duration duration_new">
                                    <h4 class = "price">{{$listOfSubscribe->duration}}</h4>
                                </div>
                                <div class="premium_logo_container new_logo_container">
                                    <img src="/assets/img/new.png" class="premium_logo " alt="Premium">
                                </div>

                                <div class="flex subscribe_text_container">
                                    <img src="/assets/img/check.png" class="check_logo" alt="logo">
                                    <p>Ранний доступ ко всем аудио новинкам</p>
                                </div >
                                <div class="flex subscribe_text_container">
                                    <img src="/assets/img/check.png" class="check_logo" alt="logo">
                                    <p>Ранний доступ ко всем новинкам в PDF формате</p>
                                </div>
                                @if($listOfSubscribe->checkAffiliation())
                                    <h4 class="subscribed">Подписка оформлена</h4>
                                @else
                                <a href="{{route('payment', $listOfSubscribe)}}" class="link_price"><div class="duration_container price_container">
                                        <h4 class="price">Оплатить {{$listOfSubscribe->listSubscribePrice}}грн</h4>
                                    </div></a>
                                @endif

                            </div>
                        @endIf
                    @endforeach
                </div>
            </div>
            </section>

        </div>
    </div>


@endsection
