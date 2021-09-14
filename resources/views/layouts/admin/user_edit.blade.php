@include('includes.head')

<body>
@include('includes.navbar')

@include('includes.scripts')

@include('includes.errors')


<form action="{{route('admin.userEditSubmit', $user )}}" method = "Post">

    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="name" value="{{$user->name}}" placeholder="Введите имя" id = "name" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="surname" value="{{$user->surname}}" placeholder="Введите фамилию" id = "surname" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="email" value="{{$user->email}}" placeholder="Введите email" id = "email" class="form-control">
    </div>
    <div class="form-group">
        <label for="name"></label>
        <input type="text" name="birthday" value="{{$user->birthday}}" placeholder="Введите день рождения" id = "email" class="form-control">
    </div>


    <button type="submit" class="btn btn-success">Edit user</button>


</form>
</body>
</html>
