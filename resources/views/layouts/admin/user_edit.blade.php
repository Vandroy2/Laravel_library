@include('includes.admin.head')

<body>
@include('includes.admin.navbar')

@include('includes.admin.scripts')

@include('includes.errors')


<form action="{{route('admin.userUpdate', $user )}}" method = "Post" enctype="multipart/form-data">

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
    @can('ban')
        <div class="form-group">
            <label for="name"></label>
            <input type="text" name="banned" value="{{$user->banned}}" placeholder="Введите день рождения" id = "email" class="form-control">
        </div>
    @endcan

    <div class="form-group" style="display: flex;flex-wrap: wrap">
        <label for="name"></label>
        @foreach($user->images as $image)
            <div class = "con_img ">
                <a href="{{route('admin.imageDeleteByUser', $image)}}"><img src="http://www.veryicon.com/icon/48/System/Must%20Have/Remove.png" alt="Remove" class="clear_buton" title="Удалить" width="30" height="30" /></a>
                <img class = "img" src="{{asset('/storage/'. $image->images)}}" >
            </div>
        @endforeach
    </div>
    <label style="display: flex;flex-direction: column">
        <input type="file" id="images" accept=".jpg, .png" name="images[]" multiple>
        <span class="icon-user"></span>

    </label>

    <button type="submit" class="btn btn-success">Edit user</button>


</form>
</body>
</html>
