@extends('layouts.admin.adminMain')

@section('content')

    <div class="admin_create_container" style="">

        @include('includes.errors')

        <div class="secondary_container">

            <h3 class = "admin_main_text">Создание жанра</h3>

    <form method = "Post"
          @if(isset($genre))

          action="{{route('admin.genres.update', $genre->id)}}"

          @else
          action="{{route('admin.genres.store')}}"
          @endif
          class = "form-group" enctype="multipart/form-data">

        @if(isset($genre))
        @method('PUT')
        @endif

        @csrf

        <div class="form-group">
            <label for="book_name"></label>
            <input type="text" name="genre_name" class="form-control-range" style="width: 500px"
                   @isset($genre)
                   value="{{old('genre_name')? : $genre->genre_name}}"
                   @else
                   value="{{old('genre_name')}}"
                @endisset
            >
        </div>

        <div class="form-group" >
            <label for="name"></label>
            @isset($genre)
                <div class = "con_img ">
                    @if(isset($genre->image))
                    <a href="{{route('admin.imageDelete', ['image' => $genre->image->images])}}"><img src="http://www.veryicon.com/icon/48/System/Must%20Have/Remove.png" alt="Remove" class="clear_buton" title="Удалить" width="30" height="30" /></a>
                        <img class = "img" src="{{asset('/storage/'. $genre->image->images)}}" >
                    @endif
                </div>
            @endisset
        </div>
            <div class="form-group genre_text">
        <label>
            <input type="file" id="images" accept=".jpg, .png, .jpeg" name="image">
            <span class="icon-user"></span>

        </label>
            </div>



        <button type="submit" class="btn btn-success">Сохранить</button>

    </form>
        </div>
    </div>


@endsection


