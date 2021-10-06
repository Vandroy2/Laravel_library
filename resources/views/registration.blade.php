@include('includes.main.head')
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
                    <form class="form-subscribe"  id="contactForm" style="margin-left: 200px; margin-top: 300px; width: 45%" action="{{route('registration')}}" method="post">
                    @csrf
                    <!-- Email address input-->
                        <div class="row">
                            <div class="col">
                                <input class="form-control form-control-lg" id="emailAddress" type="email" name="email" placeholder="Input email" data-sb-validations="required,email" />
                                <input class="form-control form-control-lg" id="emailAddress" type="password" name="password" placeholder="Input password" data-sb-validations="required" />
                                <input class="form-control form-control-lg" id="emailAddress" type="text" name="name" placeholder="Input name" data-sb-validations="required" />
                                <input class="form-control form-control-lg" id="emailAddress" type="text" name="surname" placeholder="Input surname" data-sb-validations="required" />
                                <input class="form-control form-control-lg" id="emailAddress" type="text" name="birthday" placeholder="Input birthday" data-sb-validations="required" />
                                <div class="file-upload">
                                    <label>
                                        <input type="file" id="images" accept=".jpg, .png" name="images[]" multiple>
                                        <span class="icon-user"></span>

                                    </label>
                                </div>
                                <button class="btn btn-primary btn-lg " id="submitButton" type="submit">Registration</button>
                                <div class="invalid-feedback text-white" data-sb-feedback="emailAddress:required">Email Address is required.</div>
                                <div class="invalid-feedback text-white" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>


                            </div>


                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</header>
