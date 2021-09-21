@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')

<form action="{{route('admin.bookCreateSubmit')}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="" placeholder="Введите название книги" id = "name" class="form-control">
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



    <button type="submit" class="btn btn-success">Add book</button>

</form>
</body>
</html>
