@extends('layouts.admin.adminMain')


@section('content')

    <div class="admin_create_container">

        @include('includes.errors')

        <div class="secondary_container">

            <h3 class = "admin_main_text">Создание города</h3>

<form  method = "Post"
       @isset($city)
       action="{{route('admin.cityUpdate', $city)}}"
       @else
       action="{{route('admin.cityStore')}}"
       @endisset

>

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="city_name" placeholder="Введите название города" id = "name" class="form-group genre_text"
               @isset($city)
               value="{{old('city_name')?: $city->city_name}}"
               @else
               value="{{old('city_name')}}"
            @endisset
        >
    </div>


    <button type="submit" class="btn btn-success">
        @isset($city)
            Редактировать город
        @else
        Добавить город
            @endisset

    </button>

</form>
</div>
</div>


@endsection

