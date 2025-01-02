<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title> Register - SAFE EYE</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo/logo.png')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->





    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0" style="background-image: linear-gradient(
    rgba(255, 255, 255, 0.8),rgba(255, 255, 255, 0.8)),url('{{asset("images/logo/logo.jpeg")}}'); background-position:top center;background-repeat:no-repeat">
                            <div class="card-body pt-5">

                                    <a class="text-center" href="/"> <h4>SAFE EYE</h4></a>

                                       <!-- Error Alert -->
                                @if ($errors->any())
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="position:fixed; top:15px; right:15px; z-index:10">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach

                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                    <form method="POST" action="{{ route('register.post') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control bg-transparent" placeholder="Name" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control bg-transparent" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control bg-transparent" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" class="form-control bg-transparent" placeholder="Confirm Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </form>
                                    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{asset('plugins/common/common.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/settings.js')}}"></script>
    <script src="{{asset('js/gleek.js')}}"></script>
    <script src="{{asset('js/styleSwitcher.js')}}"></script>
</body>
</html>
