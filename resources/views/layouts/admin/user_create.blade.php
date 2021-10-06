@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')

<form action="{{route('admin.userStore')}}" method = "Post" enctype="multipart/form-data">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="" placeholder="Введите имя" id = "name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="surname" value="" placeholder="Введите фамилию" id = "surname" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="email" value="" placeholder="Введите email" id = "email" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="birthday" value="" placeholder="Введите день рождения" id = "email" class="form-control">
    </div>

    <div class="file-upload">
        <label>
            <input type="file" id="images" accept=".jpg, .png" name="images[]" multiple>
            <span class="icon-user"></span>

        </label>
    </div>

    <button type="submit" class="btn btn-success">Add user</button>

</form>
</body>
</html>
