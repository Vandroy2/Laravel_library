

<header class="masthead">

    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="text-center text-white">
                    @include('includes.errors')

                    <h1 class="mb-5">Generate more leads with a professional landing page!</h1>
                    @if(!\Illuminate\Support\Facades\Auth::check())
                        <form class="form-subscribe" id="contactForm" style="margin-left: 800px; width: 50%; " action="{{route('auth')}}" method="post">
                        @csrf
                        <!-- Email address input-->
                            <div class="row">
                                <div class="col">
                                    <input class="form-control form-control-lg" id="emailAddress" type="email" name="email" placeholder="Email Address" data-sb-validations="required,email" />
                                    <input class="form-control form-control-lg" id="emailAddress" type="password" name="password" placeholder="Password" data-sb-validations="required" />
                                    <button class="btn btn-primary btn-lg " id="submitButton" type="submit">Login</button>
                                    <div class="invalid-feedback text-white" data-sb-feedback="emailAddress:required">Email Address is required.</div>
                                    <div class="invalid-feedback text-white" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
                                </div>
                                <div class="col-auto"></div>
                            </div>

                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
