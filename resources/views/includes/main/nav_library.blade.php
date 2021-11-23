<nav class="navbar navbar-expand-lg navbar-light bg-light" id="nav_library">


    <div style="display: flex; flex-direction: column; width: 25%; margin-left: 50px">
        <form action="{{ route('onlineLibrary') }}" method="post">
            @csrf
            <label>
                <input name="search_book" placeholder="Search" type="search">
            </label>
            <button type="submit" style="width: 25%">Search</button>
        </form>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: space-between">
        <div class="mr-auto"></div>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <a class="btn btn-light" style="font-family: 'DejaVu Serif'; padding-top: 8px" disabled>Hello {{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                @endif

            </li>

@auth()
                <div style="display: flex; justify-content: space-between">
                    <a href="{{route('onLineLibraryFavoritesBooks')}}">



                        <h6 class="number_nav" id = "cartCount" style="position: absolute; right: 210px;top: 17px; z-index: 1000; color: black; font-weight: bolder; font-family: Libre Baskerville,fantasy">
                            {{count(\Illuminate\Support\Facades\Auth::user()->books)}}
                        </h6>
                        <img src="/assets/img/star.png" alt="Remove" class="clear_buton" width="35" height="35" style="position: relative" >
                    </a>

                    @endauth
                    <a class="navButtonBasket">
                        @if(!empty(\Illuminate\Support\Facades\Session::get('cartBooks')))
                        <h6 class="number_nav" id = "basketCount" style="position: absolute; right: 172px;top: 17px; z-index: 1000; color: black; font-weight: bolder; font-family: Libre Baskerville,fantasy">
                            {{count($cartBooks)}}
                        </h6>
                        @endif
                            @if(empty(\Illuminate\Support\Facades\Session::get('cartBooks')))
                            <h6 class="number_nav" id = "basketCount" style="position: absolute; right: 172px;top: 17px; z-index: 1000; color: black; font-weight: bolder; font-family: Libre Baskerville,fantasy">
                               0
                            </h6>
                            @endif
                        <img src="/assets/img/basket_book.png" class="navBasket popup-link" id="popup-link">
                    </a>

                    <li class="nav-item dropdown" style="margin-right: 50px">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Navigation
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">

                            <h6 class="dropdown-header">Select</h6>

                            <a class="btn btn-light"  href="/">Main Page</a>

                            @if(\Illuminate\Support\Facades\Auth::check())

                                <a class="btn btn-light"  href="{{route('personalCabinet')}}">Personal Cabinet</a>


                            @endif

                            @if(!\Illuminate\Support\Facades\Auth::check())

                                <a class="btn btn-light"  href="{{route('reg')}}">Registration</a>

                            @endif

                            @if(\Illuminate\Support\Facades\Auth::check())

                                <a class="btn btn-light"  href="{{route('logout')}}">Logout</a>
                            @endif

                        </div>

                    </li>
                </div>
        </ul>

    </div>

</nav>
