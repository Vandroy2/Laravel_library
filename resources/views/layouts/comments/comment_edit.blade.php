@include('includes.main.head')
@include('includes.main.nav')
@include('includes.admin.scripts')
<body style="background-image: url(https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/sunset-quotes-21-1586531574.jpg);z-index: 1000">

<header  style="height: 100vh;">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    @include('includes.errors')
                    <form role="form" action="{{route('admin.personalCabinetUpdate', $comment)}}" method = "Post">
                    @csrf
                        <div class="form-group">
                            <label for="comment_text"></label>
                            <input type="text" name="comment_text" value="{{$comment->comment_text}}" id = "comment_text" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Update comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
