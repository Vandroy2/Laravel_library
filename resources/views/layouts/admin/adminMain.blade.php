@include('includes.head')

<body class="d-flex h-100 text-center text-white bg-dark" style="background-image: url(https://www.innovasolutions.com/wp-content/uploads/2020/11/background-hd-12.jpg)">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" style="background-image: url(https://www.innovasolutions.com/wp-content/uploads/2020/11/background-hd-12.jpg)">
    <header class="mb-auto" style="background-color: #1a202c">

  @include('includes.navbar')

    </header>
    <main class="px-3" style="margin-top: 250px; ">
        @yield('content')
    </main>
</div>

    @include('includes.scripts')

</body>
</html>
