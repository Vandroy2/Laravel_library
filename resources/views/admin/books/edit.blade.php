@extends('layouts.admin.adminMain')


@section('content')

    <div class="book_create_container">

        @include('includes.errors')

        <div class="secondary_container">

            <h3 class = "admin_main_text">Создание книги</h3>

<form
    method = "Post"
    enctype="multipart/form-data" id="edit_form"
    @isset($book)
       action="{{route('admin.bookUpdate', $book)}}"
       @else
       action="{{route('admin.bookStore')}}"
       @endisset
>

    @csrf
    <div class="form-group">
        <label for="book_name"></label>
        <input type="text" name="book_name"  placeholder="Введите название" id = "book_name" class="form-group"
               @isset($book)
               value="{{old('book_name')?: $book->book_name}}"
               @else
               value="{{old('book_name')}}" required
                   @endisset>
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="number" name="num_pages" placeholder="Kоличество страниц" class="form-group"
               @isset($book)
               value="{{old('num_pages')?: $book->num_pages}}"
               @else
               value="{{old('num_pages')}}" required
            @endisset>
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="number" name="price" placeholder="Цена" class="form-group"
               @isset($book)
               value="{{old('price')?: $book->price}}"
               @else
               value="{{old('price')}}" required
            @endisset>
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="created_date" placeholder="Введите год написания" id = "birthday" class="form-group"
               @isset($book)
               value="{{old('created_date')?: $book->created_date}}"
               @else
               value="{{old('created_date')}}" required
            @endisset>

    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="books_limit" placeholder="Oстаток на складе" id = "birthday" class="form-group"
               @isset($book)
               value="{{old('books_limit')?: $book->books_limit}}"
               @else
               value="{{old('books_limit')}}" required
            @endisset>

    </div>

    <div class="form-group">

        <div class = genre_text>
            Выберите автора
        </div>

        <select class="admin genre" name="author_id" style="width: 200px;height: 38px;"
                @isset($book)
                @else
                required
            @endisset>
            @isset($book)
                <option value="{{$book->author->id}}" name="author_id"><label >{{$book->author->fullname}}</label></option>
            @else
                <option value="" name="author_id"><label >Автор</label></option>
            @endisset
            @foreach($authors as $author)
                <option value="{{$author->id}}" name="author_id">{{$author->fullname}}</option>
            @endforeach
        </select>

    </div>

    <div class="form-group">

        <div class = genre_text>
            Выберите жанр
        </div>

        <select class="admin genre" name="genre_id" style="width: 200px;height: 38px;"
                @isset($book)
                @else
                required
            @endisset>
            @isset($book)
            <option value="{{$book->genre->id}}"><label >{{$book->genre->genre_name}}</label></option>
            @else
                <option value=""><label >Жанр</label></option>
                @endisset
            @foreach($genres as $genre)
                <option value="{{$genre->id}}" name="genre_id" required>{{$genre->genre_name}}</option>
            @endforeach
        </select>

    </div>

    <div class="form-group">

        <div class = genre_text>
            Выберите библиотеку
        </div>

        <select class="admin genre" name="library_id" style="width: 200px;height: 38px;"
                @isset($book)
                @else
                required
            @endisset>
            @isset($book)
                <option value="{{$book->library->id}}"><label >{{$book->library->library_name}}</label></option>
            @else
                <option value=""><label >Библиотека</label></option>
            @endisset
            @foreach($libraries as $library)
                <option value="{{$library->id}}" name="library_id" >{{$library->library_name}}</option>
            @endforeach
        </select>

    </div>

    <div class="form-group">

        <div class = genre_text>
            Выберите тип книги
        </div>

        <select class="admin genre" name="type" style="width: 200px;height: 38px;"
        @isset($book)
            @else
            required
                @endisset
        >
            @isset($book)
                <option value="{{$book->type}}"><label >{{$book->type}}</label></option>
            @else
                <option value=""><label >Тип книги</label></option>
            @endisset

                <option value="audio" name="type">audio</option>
                <option value="pdf" name="type">pdf</option>

        </select>

    </div>

    <td>

        <div class="form-group justify-content-center" style="display: flex;flex-wrap: wrap">

            <label for="name"></label>

            @isset($book)
            @foreach($book->images as $image)
                <div class = "con_img flex justify-content-center">
                    <a href="{{route('admin.imageDelete', $image)}}"><img src="http://www.veryicon.com/icon/48/System/Must%20Have/Remove.png" alt="Remove" class="clear_buton" title="Удалить" width="30" height="30" /></a>
                   <img class = "img img_book_edit" src="{{asset('/storage/'. $image->images)}}" >
                </div>
            @endforeach
                @endisset
        </div>
        <div class="form-group flex-column">

            <div class = "label_text">Выберите картинку:</div>
            <input type="file" class = "genre_text" id="images" accept=".jpg,.png,.jpeg" name="images[]" multiple
                   @isset($book)
                   @else
                   required
                @endisset
            >

        </div>

        <div class="form-group flex-column">

            <div class = "label_text">Выберите файл для книги:</div>
            <input type="file" class = "genre_text" id="images" name="file"
                   @isset($book)
                   @else
                   required
                @endisset
            >

        </div>

        <button type="submit" id="submit" class="btn btn-success">
            @isset($book)
            Редактировать книгу
            @else
            Создать книгу
                @endisset

        </button>

    </td>

</form>

        </div>
    </div>


@endsection

