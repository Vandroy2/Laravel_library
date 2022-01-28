<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div style="display: flex; flex-direction: column; width: 25%; margin-left: 50px">
        <ul class="nav-item active">
            @if(\Illuminate\Support\Facades\Auth::check())
                <a class="btn btn-light" style="font-family: 'DejaVu Serif'; padding-top: 8px" disabled>Hello {{\Illuminate\Support\Facades\Auth::user()->name}}</a>
            @endif

        </ul>

    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: space-between">
        <div class="mr-auto"></div>
        <ul class="navbar-nav my-2 my-lg-0">

            <li class="nav-item dropdown " style="margin-right: 50px" >
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Navigation
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">

                    <h6 class="dropdown-header">Select</h6>
                    <a class="dropdown-item"  href="/">Main page</a>
                    <a class="dropdown-item personalCabinet"  href="{{route('personalCabinet')}}">Personal Cabinet</a>
                    <a class="dropdown-item"  href="{{route('onlineLibrary')}}">Library</a>
                    <a class="dropdown-item"  href="{{route('personalCabinetOrders')}}">Orders</a>
                    <a class="dropdown-item"  href="{{route('onLineLibraryFavoritesBooks')}}">Favorites Books</a>
                    <a class="dropdown-item"  href="{{route('purchasedBooks')}}">Purchased Books</a>
                    <a class="dropdown-item"  href="{{route('personalCabinetComments')}}">Comments</a>
                    <a class="dropdown-item"  href="{{route('subscribes')}}">Subscribes</a>
                    <a class="dropdown-item"  href="{{route('logout')}}">Logout</a>


                </div>

            </li>

        </ul>

    </div>
</nav>
