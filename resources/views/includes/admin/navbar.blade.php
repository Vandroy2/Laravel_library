<nav class="navbar navbar-expand-lg navbar-light bg-light">




    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto"></div>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Users
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">



                    <h6 class="dropdown-header">Select</h6>

                   <a class="dropdown-item" href="{{route('admin.users')}}">Users List</a>
                    @can('admin.create')
                   <a class="dropdown-item" href="{{route('admin.userCreate')}}">User create</a>
                    @endcan


                </div>

            </li>

        </ul>

    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto"></div>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    City
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">



                    <h6 class="dropdown-header">Select</h6>

                    <a class="dropdown-item" href="{{route('admin.cities')}}">Cities List</a>
                    <a class="dropdown-item" href="{{route('admin.cityCreate')}}">City create</a>

                </div>

            </li>

        </ul>

    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto"></div>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    libraries
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">



                    <h6 class="dropdown-header">Select</h6>
                    <a class="dropdown-item" href="{{route('admin.libraries')}}">Libraries list</a>
                    <a class="dropdown-item" href="{{route('admin.libraryCreate')}}">Libraries Create</a>


                </div>

            </li>

        </ul>

    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto"></div>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Authors
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">

                    <h6 class="dropdown-header">Select</h6>
                    <a class="dropdown-item" href="{{route('admin.authors')}}">Authors list</a>
                    <a class="dropdown-item" href="{{route('admin.authorCreate')}}">Authors Create</a>


                </div>

            </li>

        </ul>

    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto"></div>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Books
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">



                    <h6 class="dropdown-header">Select</h6>

                    <a class="dropdown-item" href="{{route('admin.books')}}">Books list</a>
                    <a class="dropdown-item" href="{{route('admin.bookCreate')}}">Book Create</a>
                    <a class="dropdown-item" href="{{route('admin.bookSelection')}}">Book selection</a>


                </div>

            </li>

        </ul>

    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto"></div>
        <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item active">

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Navigation
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">

                    {{--              <h6 class="dropdown-header">{{$auth_user ?? ''->name}}</h6>--}}

                    <h6 class="dropdown-header">Select</h6>

                    <a class="dropdown-item" href="/">Main page</a>
                    <a class="dropdown-item" href="/admin">Main admin page</a>
                    <a class="dropdown-item" href="{{route('admin.personalCabinet')}}">Personal Cabinet</a>
                    <a class="dropdown-item" href="{{route('admin.orders')}}">Orders</a>
                    <a class="dropdown-item" href="{{route('admin.logout')}}">logout</a>



                </div>

            </li>

        </ul>

    </div>
</nav>
