@include('includes.main.head')
<body style="background-image: url(https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/sunset-quotes-21-1586531574.jpg);z-index: 1000">
<header  style="height: 100vh;">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    @include('includes.errors')
                    <form role="form" action="{{route('commentStore')}}" method = "Post">
                        @csrf
                        <div class="form-group">
                            <label for="textarea"></label>
                            <textarea class="form-control" id="textarea" name="comment_text" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Add comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
