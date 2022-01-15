@extends('layouts.admin.adminMain')


@section('content')

<div class="admin_create_container">

    @include('includes.errors')

    <div class="secondary_container">

        <h3 class = "admin_main_text">Создание автора</h3>

    <form  method = "Post"
           @isset($author)
           action="{{route('admin.authorUpdate', $author)}}"
           @else
           action="{{route('admin.authorStore')}}"
        @endisset>

        @csrf
        <div class="form-group">
            <label for="name"></label>
            <input type="text" name="author_name" placeholder="Введите имя" id = "author_name" class="form-group"
                   @isset($author)
                   value = "{{old('author_name')? : $author->author_name}}"
                   @else
                   value = "{{old('author_name')}}"
                @endisset>
        </div>
        <div class="form-group">
            <label for="name"></label>
            <input type="text" name="author_surname"  placeholder="Введите фамилию" id = "author_surname" class="form-group"
                   @isset($author)
                   value = "{{old('author_surname')? : $author->author_surname}}"
                   @else
                   value = "{{old('author_surname')}}"
                @endisset>
        </div>
        <div class="form-group">
            <label for="name"></label>
            <input type="text" name="birthday" placeholder="Введите дату рождения" id = "birthday" class="form-group"
                   @isset($author)
                   value = "{{old('author_birthday')? : $author->birthday}}"
                   @else
                   value = "{{old('author_birthday')}}"
                @endisset>
        </div>

        <button type="submit" class="btn btn-success admin_btn">Edit author</button>

    </form>
    </div>
</div>



@endsection

