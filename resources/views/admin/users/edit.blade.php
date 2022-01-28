
@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_create_container" style="">

        <div class="secondary_container">

            <h3 class = "admin_main_text">Создание пользователя</h3>


<form  method = "Post" enctype="multipart/form-data"
       @isset($user)
       action="{{route('admin.userUpdate', $user )}}"
       @else
       action="{{route('admin.userStore')}}"
       @endisset
>

    @csrf

    @can('admin.create')

    <div class="form-group">

        <div class = genre_text>
            Выберите тип пользователя
        </div>

        <select class="admin genre" name="premium" style="width: 200px;height: 38px;"
                @isset($user)
                @else
                required
            @endisset
        >
            @isset($user)
                <option value="{{$user->premium}}"><label >
                        @if($user->premium)
                        Premium
                        @else
                        Default
                        @endif

                    </label></option>
            @else
                <option value="0"><label >Тип пользователя</label></option>
            @endisset

            <option value="1" name="type">Premium</option>
            <option value="0" name="type">Default</option>

        </select>

    </div>

    @endcan

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name"  placeholder="Введите имя" id = "name" class="form-group"
               @isset($user)
               value="{{old('name')?: $user->name}}"
               @else
               value="{{old('name')}}"
            @endisset
        >
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="surname" placeholder="Введите фамилию" id = "surname" class="form-group"
               @isset($user)
               value="{{old('surname')?: $user->surname}}"
               @else
               value="{{old('surname')}}"
            @endisset>
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="email" placeholder="Введите email" id = "email" class="form-group"
               @isset($user)
               value="{{old('email')?: $user->email}}"
               @else
               value="{{old('email')}}"
            @endisset>
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="birthday" placeholder="Введите день рождения" id = "email" class="form-group"
               @isset($user)
               value="{{old('birthday')?: $user->birthday}}"
               @else
               value="{{old('birthday')}}"
            @endisset>
    </div>
    @can('ban')
        <div class="form-group">
            <label for="name"></label>
            <input type="text" name="banned" placeholder="Введите день рождения" id = "email" class="form-group"
                   @isset($user)
                   value="{{old('banned')?: $user->banned}}"
                   @else
                   value="{{old('banned')}}"
                @endisset>

        </div>
    @endcan

    <div class="form-group" style="display: flex;flex-wrap: wrap;justify-content: center">
        <label for="name"></label>
        @isset($user)
        @foreach($user->images as $image)
            <div class = "con_img ">
                <a href="{{route('admin.imageDeleteByUser', $image)}}"><img src="http://www.veryicon.com/icon/48/System/Must%20Have/Remove.png" alt="Remove" class="clear_buton" title="Удалить" width="30" height="30" /></a>
                <img class = "img img_user_edit" src="{{asset('/storage/'. $image->images)}}" >
            </div>
        @endforeach
        @endisset
    </div>
    <div class="form-group genre_text">
        <label>
            <input type="file" id="images" accept=".jpg, .png" name="images[]" multiple>
            <span class="icon-user"></span>

        </label>
    </div>


    <button type="submit" class="btn btn-success">
        @isset($user)
        Редактировать пользователя
        @else
        Добавить пользователя
        @endisset
    </button>


</form>
        </div>
    </div>

@endsection
