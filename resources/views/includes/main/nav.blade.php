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
                    <a class="dropdown-item" style="padding-top: 8px" disabled>Hello {{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                @endif

            </li>

            <li class="nav-item dropdown" style="margin-right: 50px">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Navigation
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">

                    <h6 class="dropdown-header">Select</h6>

                    <a class="dropdown-item"  href="/">Main Page</a>

                    @if(\Illuminate\Support\Facades\Auth::check())

                        <a class="dropdown-item personalCabinet"  href="{{route('personalCabinet')}}">Personal Cabinet</a>
                    @endif
                        <a class="dropdown-item"  href="{{route('onlineLibrary')}}">Library</a>


                    @if(!\Illuminate\Support\Facades\Auth::check())

                        <a class="dropdown-item"  href="{{route('reg')}}">Registration</a>

                    @endif

                    @if(\Illuminate\Support\Facades\Auth::check())

                        <a class="dropdown-item"  href="{{route('logout')}}">Logout</a>
                    @endif

                </div>

            </li>







@include('includes.main.scripts')
</nav>

