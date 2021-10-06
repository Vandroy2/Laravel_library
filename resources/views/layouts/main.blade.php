@include('includes.main.head')
<body>
@include('includes.main.nav')
@include('includes.admin.scripts')
@include('includes.main.header')
@yield('content')
@include('layouts.comments.comments')

@include('includes.main.footer')


