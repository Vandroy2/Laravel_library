<header class="masthead">

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    @include('includes.errors')

                    <h1 class="mb-5 headerTitle" >Generate more leads with a professional landing page!</h1>

                </div>
            </div>
        </div>
    </div>

</header>
<div  class="buttons_filter_container">
    <a href="{{route('admin.bookTop10')}}"><button class="btn btn-secondary btn_filter">Топ 10 книг</button></a>
    <a href="{{route('admin.bookNewest')}}"><button class="btn btn-secondary btn_filter">Новинки</button></a>
    <a href="{{route('admin.bookTopAuthors')}}"><button class="btn btn-secondary btn_filter">Топ 5 авторов</button></a>
    <a href="{{route('admin.bookTopGenres')}}"><button class="btn btn-secondary btn_filter">Топ 3 жанра</button></a>
    <a href="{{route('admin.bookLowPrice')}}"><button class="btn btn-secondary btn_filter">Недорогие книги</button></a>
</div>
