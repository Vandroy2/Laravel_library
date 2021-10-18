@include('includes.main.head')
@include('includes.main.personalNav')
@include('includes.admin.scripts')

<body >
<section style="display: flex; flex-wrap:wrap ;text-align: left; height: 100vh;background-image: url(https://images.adsttc.com/media/images/5f17/67a5/b357/65a5/ed00/0076/large_jpg/Luuk_Kramer_study_library_19260-101.jpg?1595369364)">
    @foreach($books as $book)
        <div class="container row align-items-start" style="height: 18rem; width:calc( ( 100% - 40px ) / 8 ); margin-top: 30px;">

            <div style="width: max-content; height: 20rem; display: flex; position: relative">

                <div style="display: flex; flex-direction: column;">

                    <form action="{{route('onLineLibraryAddToFavoritePersonal', $book)}}" method = "Post"  style="margin-bottom: 5px ; margin-top: 10px;position: absolute; left: 5px; top: -10px; z-index: 1000;">
                        @csrf
                        <button type="submit" class="border-0 bg-transparent btn-ens-action btn-ens-style " data-rel="4a9f99dc105">
                            @auth()
                                @if(\Illuminate\Support\Facades\Auth::user()->books->contains($book))
                                    <img src="https://pngicon.ru/file/uploads/zvezda.png" alt="Remove" class="clear_buton" id="favImgId{{$book->id}}" title="Удалить" width="25" height="25">
                                @else
                                    <img src="http://s1.iconbird.com/ico/2013/6/363/w256h2561372346250Favorite256.png" alt="Remove" class="clear_buton" id="favImgId{{$book->id}}" title="Удалить" width="25" height="25" />
                                @endif
                            @endauth
                        </button>
                    </form>
                    <div class="card" style="width: 11.1rem; height: 16rem;border-radius: 10px">
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
                            <p class="card-text" style="position: absolute; left:5px ; bottom: 0; z-index: 1000;">Осталось книг:{{$book->books_limit}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>

</body>


