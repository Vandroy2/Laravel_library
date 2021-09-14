@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')

<form action="{{route('admin.userCreateSubmit')}}" method = "Post">

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


    <button type="submit" class="btn btn-success">Add user</button>


</form>
</body>
</html>
