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

                    {{--              <h6 class="dropdown-header">{{$auth_user ?? ''->name}}</h6>--}}

                    <h6 class="dropdown-header">Select</h6>

                   <a class="dropdown-item" href="{{route('admin.users')}}">Users List</a>
                   <a class="dropdown-item" href="{{route('admin.userCreate')}}">User add</a>


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

                    {{--              <h6 class="dropdown-header">{{$auth_user ?? ''->name}}</h6>--}}

                    <h6 class="dropdown-header">Select</h6>

                    <a class="dropdown-item" href="/">main page</a>
                    <a class="dropdown-item" href="{{route('admin.logout')}}">logout</a>
                 <a class="dropdown-item" href="{{route('admin.users')}}">Add user</a>

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

                    {{--              <h6 class="dropdown-header">{{$auth_user ?? ''->name}}</h6>--}}

                    <h6 class="dropdown-header">Select</h6>

                    <a class="dropdown-item" href="/">main page</a>
                    <a class="dropdown-item" href="{{route('admin.logout')}}">logout</a>
{{--                    <a class="dropdown-item" href="{{route('user_add')}}">Add user</a>--}}

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

                    {{--              <h6 class="dropdown-header">{{$auth_user ?? ''->name}}</h6>--}}

                    <h6 class="dropdown-header">Select</h6>

                    <a class="dropdown-item" href="/">main page</a>
                    <a class="dropdown-item" href="{{route('admin.logout')}}">logout</a>
{{--                    <a class="dropdown-item" href="{{route('user_add')}}">Add user</a>--}}

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
                    <a class="dropdown-item" href="{{route('admin.logout')}}">logout</a>
                    <a class="dropdown-item" href="{{route('admin.users')}}">Users list</a>


                </div>

            </li>

        </ul>

    </div>
</nav>
