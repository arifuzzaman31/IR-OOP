<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{('admin-assets/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    @include('partials.header-assets')
</head>

<body class="form">


    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Reset Password</h1>
                        <p class="text-muted">Enter your Email and instructions will be sent to you! </p>

                        <form class="text-left" method="post" role="form" action="{{route('send-reset-mail')}}">
                            <div class="form">
                                @csrf
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">EMAIL</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="username" value="{{ old('email') }}" name="email" type="text" class="form-control" placeholder="e.g xyz@gmail.com">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary">Send Reset Link</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if(session()->has('message'))
                        <h5 class="text-success mt-3">{!! session()->get('message') !!}</h5>
                        @endif
                        @if(session()->has('error'))
                        <h5 class="text-danger mt-3">{!! session()->get('error') !!}</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('partials.footer-assets')
</body>

</html>