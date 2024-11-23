<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V16</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('user/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('user/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('user/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('user/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('user/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('user/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
<!--===============================================================================================-->
<style>
    .form-wrapper{
        backface-visibility: hidden;
        width: 100%;
			height: 100%;
			position: absolute;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			background: white;
			border-radius: 10px;
            padding: 10px 0px;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
        .flip-card {
   
        width: 400px;
    
		transform-style: preserve-3d;
		transition: transform 0.8s ease-in-out;
           
		}
        .signup {
			transform: rotateY(180deg);
		}

        .toggle {
			cursor: pointer;
			color: #6e8efb;
			font-size: 14px;
			margin-top: 10px;
		}

		.toggle:hover {
			text-decoration: underline;
		}
        .login {
			z-index: 2;
		}
        .flip-card.flipped {
			transform: rotateY(180deg);
		}
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .addd {
            position: absolute;
            transform: translate(-50%,-50%);
            top: 15%;
            left: 50%;
        }


</style>
</head>
<body style="background-image: url('{{ asset('user/images/bg-01.jpg') }}');">
	
   <div class="addd">
    <div class="flip-card" id="auth-card">
        <div class="form-wrapper login">
            <h4>Login Form</h4>
            <form class="login100-form validate-form p-b-33 p-t-5" action="{{ route('login.check') }}" method="POST">
                @csrf
                <div class="wrap-input100 validate-input" data-validate = "Enter E-mail">
                    <input class="input100 @error('logemail')
                        is-invalid
                    @enderror" type="email" name="logemail" placeholder="Enter E-mail" value="{{ old('logemail') }}">
                    @error('logemail')
                        <span class="badge bg-danger">{{ $message }}</span>
                    @enderror
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100 @error('logpassword') is-invalid @enderror" type="password" name="logpassword" placeholder="Password">
                    @error('logpassword')
                        <span class="badge bg-danger">{{ $message }}</span>
                    @enderror
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                </div>

                <div class="container-login100-form-btn m-t-32" >
                    <button class="login100-form-btn" type="submit">
                        Login
                    </button>
                    
                </div>

            </form>
            <button class="login100-form-btn" id="show-signup">
                Create Account?
            </button>
        </div>

        <div class="form-wrapper signup">
            <h4>Signup Form</h4>
            <form class="login100-form validate-form p-b-33 p-t-5" action="{{ route('user.register') }}" method="POST">
                @csrf
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input class="input100 @error('username') is-invalid @enderror" value="{{ @old('username') }}" type="text" name="username" placeholder="User name">
                    @error('username')
                        <span class="badge bg-danger">{{$message }}</span>
                    @enderror
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Enter email">
                    <input class="input100 @error('email') is-invalid @enderror" value="{{ @old('email') }}" type="email" name="email" placeholder="User E-mail">
                    @error('email')
                        <span class="badge bg-danger">{{$message }}</span>
                    @enderror
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100 @error('password') is-invalid @enderror" value="{{ @old('password') }}" type="password" name="password" placeholder="Password">
                    @error('password')
                        <span class="badge bg-danger">{{$message }}</span>
                    @enderror
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                </div>

                <div class="container-login100-form-btn m-t-32">
                    <button class="login100-form-btn" type="submit">
                        Signup
                    </button>
                    
                </div>

            </form>
            <button class="login100-form-btn" id='show-login'>
                Login?
            </button>
        </div>
    </div>
   </div>
	
	
<!--===============================================================================================-->
	<script src="{{ asset('user/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="{{ asset('user/js/main.js') }}"></script>
    <script>
        @if(Session::has('message'))
            var message = "{{ Session::get('message') }}";
            var type = "{{ Session::get('alert-type', 'info') }}";
            
            switch(type) {
                case 'info':
                    toastr.info(message);
                    break;
                case 'success':
                    toastr.success(message);
                    break;
                case 'warning':
                    toastr.warning(message);
                    break;
                case 'error':
                    toastr.error(message);
                    break;
            }
        @endif

		const $card = $('#auth-card');
        const $showSignup = $('#show-signup');
        const $showLogin = $('#show-login');

        $showSignup.on('click', function () {
            $card.addClass('flipped');
        });

        $showLogin.on('click', function () {
            $card.removeClass('flipped');
        });


        
	</script>

</body>
</html>

