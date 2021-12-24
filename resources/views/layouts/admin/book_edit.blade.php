@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')


<form action="{{route('admin.bookUpdate', $book)}}" method = "Post" enctype="multipart/form-data" id="edit_form">

    @csrf
    <div class="form-group">
        <label for="book_name"></label>
        <input type="text" name="book_name" value="{{$book->book_name}}" placeholder="Введите имя" id = "book_name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="num_pages" value="{{$book->num_pages}}" placeholder="Введите имя" id = "ыгкname" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="created_date" value="{{$book->created_date}}" placeholder="Введите имя" id = "birthday" class="form-control">
    </div>

    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="author_id" value="{{$book->author->id}}" placeholder="Введите имя" id = "birthday" class="form-control">
    </div>

    <div class="form-group">

        <div class = genre_text>
            Выберите жанр
        </div>

        <select class="admin genre" name="genre_id" style="width: 200px;height: 38px;">
            <option value=""><label >{{$book->genre->genre_name}}</label></option>
            @foreach($genres as $genre)
                <option value="{{$genre->id}}" name="" >{{$genre->genre_name}}</option>
            @endforeach
        </select>

    </div>
    <td>



        <div class="form-group" style="display: flex;flex-wrap: wrap">
            <label for="name"></label>
            @foreach($book->images as $image)
                <div class = "con_img ">
                    <a href="{{route('admin.imageDelete', $image)}}"><img src="http://www.veryicon.com/icon/48/System/Must%20Have/Remove.png" alt="Remove" class="clear_buton" title="Удалить" width="30" height="30" /></a>
                   <img class = "img" src="{{asset('/storage/'. $image->images)}}" >
                </div>
            @endforeach
        </div>
        <label style="display: flex;flex-direction: column">
            <input type="file" id="images" accept=".jpg, .png" name="images[]" multiple>
            <span class="icon-user"></span>

        </label>
        <button type="submit" id="submit" class="btn btn-success">Edit book</button>
{{--        @foreach($book->images as $image)--}}
{{--            <img class="img-fluid" src="{{asset('/storage/'. $image->book_images)}}" width="150" height="200" />--}}
{{--        @endforeach--}}
    </td>






</form>
</body>
<script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous">
</script>
<script>

    $(".clear_buton").click(function(event){
        $(this).closest(".con_img").remove();
    });

    $('.clear_buton').on('click', function(e) {

        e.preventDefault();
        let $this = $(this);
        let url = $this.parent().attr('href');
        console.log(url);
        data = $this.data();

        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function(d) {
                console.log(d);
            },
            error: function(d) {
                console.log(d);
            }
        })
    })



</script>
</html>
