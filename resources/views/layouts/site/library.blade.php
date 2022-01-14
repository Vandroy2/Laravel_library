@include('includes.main.head')
<body class="wrapper">
@include('includes.main.nav_library')
@include('includes.admin.scripts')

@include('includes.main.header_library')
@yield('content')


@include('includes.main.footer')
</body>
