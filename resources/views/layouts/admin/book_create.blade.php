@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')

<form action="{{route('admin.bookStore')}}" method = "Post" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
        <label for="book_name"></label>
        <input type="text" name="book_name" value="" placeholder="Введите название книги" id = "book_name" class="form-control">
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="num_pages" value="" placeholder="Введите колличество страниц" id = "num_pages" class="form-control">
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="created_date" value="" placeholder="Введите год написания книги" id = "created_date" class="form-control">
    </div>


    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="author_id" value="" placeholder="Введите id автора" id = "author_id" class="form-control">
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="library_id" value="" placeholder="Введите id библиотеки" id = "author_id" class="form-control">
    </div>

    <div class="file-upload">
        <label>
            <input type="file" id="images" accept=".jpg, .png" name="images[]" multiple>
            <span class="icon-user"></span>

        </label>
    </div>



    <button type="submit" class="btn btn-success">Add book</button>

</form>
</body>
</html>
