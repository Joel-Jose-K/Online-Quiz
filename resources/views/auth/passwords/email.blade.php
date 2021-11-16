<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css') }}">
</head>

<body class="text-left">
    <div class="auth-layout-wrap">
        <div class="auth-content">
            <div class="card o-hidden">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="p-4">
                            <h1 class="mb-3 text-18">Forgot Password</h1>
                            <form method="POST" action="{{ route('password.reset') }}">
                                @csrf
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <p class="alert alert-warning">{{ $error }}</p>
                                    @endforeach
                                @endif

                                @if(Session::has('msg'))
                                    <p class="alert alert-success">{{ session('msg') }}</p>
                                @endif

                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input id="email" name="email" class="form-control form-control-rounded" type="email">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-rounded mt-3">Send Password Reset Link</button>

                            </form>
                            <div class="mt-3 text-center">
                                <a class="text-muted" href="{{ route('login') }}"><u>Log in</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/script.min.js') }}"></script>
</body>

</html>