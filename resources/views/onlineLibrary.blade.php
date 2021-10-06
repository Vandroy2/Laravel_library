@extends('layouts.main')
<meta name="csrf-token" content="{{ csrf_token() }}">

<body>

@section('content')

    <section style="display: flex; flex-wrap:wrap ;height: 750px;background-image: url(https://wwwaxiellcom.cdn.triggerfish.cloud/uploads/2019/03/modern-library.jpg)">
        @foreach($books as $book)
        <div class="container" style="height: 18rem; width: 11.5rem;margin-top: 50px; ">

            <div style="width: max-content; height: 20rem; display: flex; position: relative;">

                <div style="display: flex; flex-direction: column;">

                    <div class="card" style="width: 11rem; height: 15rem;border-radius: 10px;"  >
                        <div id="carouselExampleControls{{$book->id}}" class="carousel slide" data-ride="carousel" >
                            <div class="carousel-inner" style="width: 11rem; height: 9rem;border-radius: 10px">
                                @foreach($book->images as $image)
                                    <div class="carousel-item @if($loop->first) active @endif" data-interval="18000">
                                        <img src="{{asset('/storage/'. $image->images)}}" class="d-block img" style="width: 11rem; height: 9rem;border-radius: 5px" alt="...">
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
                        </div>
                    </div>


                <form action="{{route('onLineLibraryAddToFavorite', ['book' => $book])}}" class="add_fav_form" method ="POST" style="margin-bottom: 5px ; margin-top: 10px; position: absolute; left: 0; top: 0; z-index: 1000;">
                    @csrf
                    <button type="submit" class="border-0 bg-transparent btn-ens-action btn-ens-style " data-rel="4a9f99dc105">
                        @auth()
                        @if(\Illuminate\Support\Facades\Auth::user()->books->contains($book))
                                <img src="https://pngicon.ru/file/uploads/zvezda.png" alt="Remove" class="clear_buton" id="favImgId{{$book->id}}" title="Добавить в избранное" width="25" height="25">
                            @else
                                <img src="http://s1.iconbird.com/ico/2013/6/363/w256h2561372346250Favorite256.png" alt="Remove" class="clear_buton" id="favImgId{{$book->id}}" title="Удалить из избранного" width="25" height="25"/>
                            @endif

                            @endauth
                    </button>
                </form>


                </div>
            </div>
        </div>
        @endforeach
    </section>
{{$books->links()}}

    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <script>

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

                    let cartCount = document.getElementById('cartCount');

                    let num = Number(cartCount.innerText)

                    console.log(num)

                    let bookNode = document.getElementById(`favImgId${result.book.id}`)

                    if (result.added){

                        $(bookNode).attr("src","https://pngicon.ru/file/uploads/zvezda.png");

                        num += 1;

                        cartCount.innerText = num;

                    }
                    else
                    {
                        num -= 1;

                        $(bookNode).attr("src", "http://s1.iconbird.com/ico/2013/6/363/w256h2561372346250Favorite256.png")

                        cartCount.innerText = num;
                    }
                },

            });
        });
});




    </script>


@endsection


