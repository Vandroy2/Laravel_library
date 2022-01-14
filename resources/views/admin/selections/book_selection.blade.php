@extends('layouts.admin.adminMain')


@section('content')

    <div class="main_admin_filter_container genre_text">

        @include('includes.errors')

        <div class="admin_filter_container">

            <h3 class = "admin_main_text" style="color: #e5e7e6">Фильтры</h3>


    <div class="filter_container">
        <div class="filter_sub_container">
        <div class="filter_text"> Выберите жанр </div>
        <select class="admin filter genre" name="genre_id" style="width: 200px;height: 38px;">
            <option><label >Жанр</label></option>
            @foreach($genres as $genre)
                <option value="{{$genre->id}}" name="" >{{$genre->genre_name}}</option>
            @endforeach
        </select>
        </div>

        <div class="filter_sub_container">
            <div class="filter_text">Выберите автора</div>
            <select class="admin filter author" name="author_id" style="width: 200px;height: 38px;">
                <option><label >Автор</label></option>
                @foreach($authors as $author)
                    <option value="{{$author->id}}" name="" >{{$author->fullname}}</option>
                @endforeach
            </select>
        </div>

        <div class="filter_sub_container">
            <div class="filter_text">Сортировка по продажам</div>
            <select class="admin filter sales" name="sales" style="width: 200px;height: 38px;">
                <option><label >Популярность</label></option>

                <option value="sales_hi" name="" >Сначала самые популярные за месяц</option>
                <option value="sales_low" name="" >Сначала наименее популярные за месяц</option>


            </select>
        </div>

        <div class="filter_sub_container">
            <div class="filter_text">Сортировка по цене</div>
            <select class="admin filter price" name="price" style="width: 200px;height: 38px;">
                <option><label >Цена</label></option>

                <option value="price_hi" name="" >Сначала дорогие</option>
                <option value="price_low" name="" >Сначала дешевые</option>

            </select>
        </div>

    </div>

{{--</form>--}}

    <div class="flex book_selection" >

@foreach($books as $book)


        <div class="book_card_container" id = '{{$book->id}}'>
            <div class="card card_filter" id = "bookId:{{$book->id}}" >
                        <div id="carouselExampleControls{{$book->id}}" class="carousel slide div_slide_filter" data-ride="carousel" data-order-book-id = "{{$book->id}}" >
                            <div class="carousel-inner carousel_inner" style="">
                                @foreach($book->images as $image)
                                    <div class="carousel-item @if($loop->first) active @endif" data-interval="18000">
                                        <img src="{{asset('/storage/'. $image->images)}}" class="d-block img img_slide img_slide_filter" alt="..." id = "imageId:{{$book->id}}">
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
                            <p class="card-text" id = "bookLimit{{$book->id}}" style="position: absolute; left:5px ; bottom: 0; z-index: 1000;">Цена: {{$book->price}}</p>
                        </div>
                    </div>
        </div>
        @endforeach
    </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script>

        //======================================Тест========================================================================

        $(function(){

            //--------------------Фильтр по жанрам--------------------------------------------------------------------------

            changeSelect('.genre');

            //--------------------Фильтр по авторам--------------------------------------------------------------------------

            changeSelect('.author');

            //--------------------Фильтр по продажам--------------------------------------------------------------------------

            changeSelect('.sales');

            //--------------------Фильтр по цене--------------------------------------------------------------------------

            changeSelect('.price');

        });

    </script>


@endsection














