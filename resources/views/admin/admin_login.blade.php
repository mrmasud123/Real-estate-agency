<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="{{ asset('css/login-master.css') }}">

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Section -->
            <div class="col align-items-center flex-col left-section">
                <div class="text">
                    <h2>Admin Login</h2>
                    <p>Welcome back! Please enter your credentials to log in.</p>
                </div>
            </div>
            <!-- Right Section -->
            <div class="col align-items-center flex-col right-section">
                <div class="form-wrapper">
                    <form class="form sign-in" action="{{ route('admin.checklogin') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" type="email" placeholder="Enter email" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" value="{{ old('password') }}" type="password" placeholder="Enter password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Sign In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    </script>
</body>
</html>
