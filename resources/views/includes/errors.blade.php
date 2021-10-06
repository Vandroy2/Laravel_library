@if (session()->has('errors'))
    <div class="alert alert-danger">
        <ul>
            {{session('errors')}}
        </ul>
    </div>
@endif

@if(session('success'))

    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

{{--@if (session()->has('errors'))--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            {{session('errors')}}--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}

{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}

{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
