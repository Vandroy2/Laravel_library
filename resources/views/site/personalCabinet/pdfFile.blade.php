@extends('layouts.site.personalCabinet')

@section('content')

    <div class = "purchasedBooks_container">

        <section class = "main_cards_section">

            <div class = "purchasedBooks_child_container" style="" >

                <a href="{{route('admin.bookOrder', $book)}}">

                    <div class = "card_container " style="margin-left: 100px">
                                <div class="test">
                                    <div class="card" style="">
                                        <div id="carouselExampleControls{{$book->id}}" class="carousel slide" data-ride="carousel" >
                                            <div class="carousel-inner card_content_size" style=";border-radius: 10px">
                                                @foreach($book->images as $image)
                                                    <div class="carousel-item @if($loop->first) active @endif" data-interval="18000">
                                                        <img src="{{asset('/storage/'. $image->images)}}" class="d-block img card_content_size" style="border-radius: 5px" alt="...">
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls{{$book->id}}" role="button" data-slide="prev">
{{--                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--                                                <span class="sr-only">Prev</span>--}}
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls{{$book->id}}" role="button" data-slide="next">
{{--                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>--}}
{{--                                                <span class="sr-only">Next</span>--}}
                                            </a>
                                        </div>
                                        <div class="card-body card-body-premium">
                                            <h6 class="card-title">{{$book->book_name}}</h6>
                                            <p class="card-text card-text-personal">{{$book->author->fullname}}</p>
                                            <p class="card-text card-text-personal">Осталось книг:{{$book->books_limit}}</p>
{{--                                            @can('premium')--}}
{{--                                                <button class="link_pdf">--}}

{{--                                                    @if($book->type == 'pdf')--}}
{{--                                                        PDF file--}}
{{--                                                    @elseif($book->type == 'audio')--}}
{{--                                                        Audio file--}}
{{--                                                    @endif--}}
{{--                                                </button>--}}
{{--                                            @endcan--}}


                                        </div>

                                    </div>
                                    @if($book->file)

{{--                                        <img src="http://www.veryicon.com/icon/48/System/Must%20Have/Remove.png" alt="Remove" class="button_pdfFile_close hidden_block" title="Удалить" width="30" height="30" />--}}
                                        @if($book->type == 'pdf')
                                            <iframe src="{{asset('/storage/'. $book->file)}}"  class = 'pdfFile pdfFile_show_premium' id = {{$book->id}}></iframe>
                                        @elseif($book->type == 'audio')
                                            <audio controls class = 'pdfFile'>
                                                <source src="{{asset('/storage/'. $book->file)}}" type="audio/mpeg">
                                            </audio>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            @if($book->limit)
                        </a>
                    @endif

            </div>
        </section>
    </div>

{{--    @include('includes.admin.functions')--}}

@endsection
