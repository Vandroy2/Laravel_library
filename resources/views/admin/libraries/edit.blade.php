
@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_create_container" style="">

        @include('includes.errors')

        <div class="secondary_container">

            <h3 class = "admin_main_text">Создание библиотеки</h3>

<form method = "Post"
      @isset($library)
      action="{{route('admin.libraryUpdate', $library )}}"
      @else
      action="{{route('admin.libraryStore' )}}"
      @endisset
>

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="library_name" placeholder="Введите имя" id = "name"
               style="width: 350px"
               @isset($library)
               value="{{old('library_name')?: $library->library_name}}"
               @else
               value="{{old('library_name')}}"
                   @endisset

        >
    </div>

    <div class="form-group">

        <div class = "genre_text">
            Выберите город
        </div>

        <select class="admin genre genre_text" name="city_id" style="width: 200px;height: 38px;">
            @isset($library)
                <option value="{{$library->city->id}}" name="city_id"><label >{{$library->city->city_name}}</label></option>
            @else
                <option value="" name="city_id"><label >Город</label></option>
            @endisset
            @foreach($cities as $city)
                <option value="{{$city->id}}" name="city_id" required>{{$city->city_name}}</option>
            @endforeach
        </select>

    </div>

    <button type="submit" class="btn btn-success">
        @isset($library)
        Редактировать библиотеку
            @else
        Добавить библиотеку
        @endisset
    </button>


</form>
        </div>
    </div>

@endsection
