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
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <p class="alert alert-warning">{{ $error }}</p>
                                    @endforeach
                                @endif

                                @if(Session::has('msg'))
                                    <p class="alert alert-success">{{ session('msg') }}</p>
                                @endif

                                <div class="form-group"> 
                                    <label for="">E-Mail Address<sup class="text-danger">*</sup></label>
                                    <input id="email" type="email" class="form-control form-control-rounded" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <div class="feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    
                                </div>
                                <div class="form-group password-wrap ">
                                    <label for="password">Password<sup class="text-danger">*</sup></label>
                                    <input id="password" type="password" class="form-control form-control-rounded" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    
                                   
                                </div>

                                <div class="form-group password-wrap ">
                                    <label for="password-confirm">Confirm Password<sup class="text-danger">*</sup></label>
                                    <input id="password-confirm" type="password" class="form-control form-control-rounded" name="password_confirmation" required autocomplete="new-password">
                                    
                                   
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-rounded mt-3">Reset Password</button>

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