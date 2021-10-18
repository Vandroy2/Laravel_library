<nav class="navbar navbar-expand-lg navbar-light bg-light">


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
                <h6 id = "cartCount" style="position: absolute; right: 0px;top: 0; z-index: 1000;margin-right: 198px; margin-top: 50px; color: black; font-weight: bolder; font-family: Libre Baskerville,fantasy">{{count(\Illuminate\Support\Facades\Auth::user()->books)}}</h6>
                <a href="{{route('onLineLibraryFavoritesBooks')}}">
                    <img src="https://webformyself.com/wp-content/uploads/2017/124/2.jpg" alt="Remove" class="clear_buton" width="60" height="60" style="position: relative" >
                    </a>




            @endauth

            <li class="nav-item dropdown" style="margin-right: 50px">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Navigation
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">

                    <h6 class="dropdown-header">Select</h6>

                    <a class="btn btn-light"  href="/">Main Page</a>

                    @if(\Illuminate\Support\Facades\Auth::check())

                        <a class="btn btn-light"  href="{{route('personalCabinet')}}">Personal Cabinet</a>

                        <a class="btn btn-light"  href="{{route('onlineLibrary')}}">Library</a>
                    @endif

                    @if(!\Illuminate\Support\Facades\Auth::check())

                        <a class="btn btn-light"  href="{{route('reg')}}">Registration</a>

                    @endif

                    @if(\Illuminate\Support\Facades\Auth::check())

                        <a class="btn btn-light"  href="{{route('logout')}}">Logout</a>
                    @endif

                </div>

            </li>

        </ul>
    </div>





</nav>

