


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Landing Page - Start Bootstrap Theme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{\Illuminate\Support\Facades\URL::asset('assets/favicon.ico')}}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{\Illuminate\Support\Facades\URL::asset('css/styles.css')}} " rel="stylesheet" />
</head>
<body style="background-image: url(https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/sunset-quotes-21-1586531574.jpg);z-index: 1000">

<!-- Navigation-->
<nav class="navbar navbar-light bg-light static-top">
    <div class="container">

        {{--        <a class="navbar-brand" href="#!">Start Bootstrap</a>--}}
        {{--        <a class="btn btn-primary" href="#signup">Sign Up</a>--}}
    </div>
</nav>
<!-- Masthead-->
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