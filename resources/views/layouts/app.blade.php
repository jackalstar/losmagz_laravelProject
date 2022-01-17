<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <style type="text/css">
        :root {
            --primary-color: {{ getSetting('THEME_COLOR') }};
        }

    </style>
    <script>
        //set the initial theme
        const currentTheme = localStorage.getItem('theme') || "{{ getSetting('DEFAULT_THEME') }}";
        if (currentTheme) document.documentElement.setAttribute('data-theme', currentTheme);
    </script>
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fa.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('storage/images/FAVICON.png') }}">
<style>
.dropdown {
  position: relative;
  display: inline-block;
}
.dropdown:hover .dropdown-content {display: block;}
.dropbtn {
  background-color: transparent;
  color: {{ getSetting('THEME_COLOR') }};
  padding: 16px;
  font-size: 14px;
  border: none;
}
.dropdown-content {
  display: none;
  position: absolute;
  right: 0px;
  padding: 20px;
  background-image: linear-gradient(#1E1E2D, #27293D);
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
</style>
    @yield('style')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('storage/images/LOGO.png') }}"
                    alt="{{ getSetting('APPLICATION_NAME') }}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <div class="theme-switch-wrapper">
                            <a class="dark-theme-setting" title="Toggle dark mode">
                                <svg id="themeSwitch" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon icon-light stroke-width-3 iw-16 ih-16"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                            </a>
                        </div>
                    </li>   
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login') && getSetting('AUTH_MODE') == 'enabled')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register') && getSetting('AUTH_MODE') == 'enabled')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><button
                                        class="btn btn-theme">{{ __('Join Now') }}</button></a>
                            </li>
                        @endif
                    @else
                        @if (getSetting('AUTH_MODE') == 'enabled' && getSetting('PAYMENT_MODE') == 'enabled' && Auth::user()->gender == 'man')
                            <li>
                                <div class="dropdown">
                                  <button class="dropbtn">Buy</button>
                                  <div class="dropdown-content">
                                    <h3 class="text-center" style="color:white">{{round((Auth::user()->points)/60)}}</h3>  
                                    <h5 class="text-center" style="color:white">Minutes left</h5>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary" href="{{ route('pricing') }}">Buy</a>
                                    </div>
                                  </div>
                                </div>
                            </li>
                        @endif
                        @if (Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin') }}">{{ __('Admin') }}</a>
                            </li>
                        @endif

                        

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="auth-avatar" src="{{asset('storage/images/user_photos/' . $avatar['avatar_name']) }}" width=45 height=45>
                                <span class="available-stats online"></span>
                                <img id="selfCountryflag" src="" alt="Country Flag" width="25" class="mr-2" hidden />
                                {{ Auth::user()->username }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    Profile
                                </a>
                                @if (getSetting('PAYMENT_MODE') == 'enabled')
                                    @if (Auth::user()->gender == 'man')
                                    <a class="dropdown-item" href="{{ route('man_transaction') }}">
                                        Transaction
                                    </a>
                                    @else
                                    <a class="dropdown-item" href="{{ route('women_withdraw') }}">
                                        Withdraw
                                    </a>
                                    @endif
                                @endif
                                <a class="dropdown-item" href="{{ route('changePassword') }}">
                                    Change Password
                                </a>
                                <a class="dropdown-item" onclick="logoutControl('{{Auth::user()->email}}'); event.preventDefault();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <footer>
            <div class="container-fluid">
                <div class="row d-flex align-items-center">
                    <div class="col-8 text-left pad-res">
                        <ul class="footer-links">
                            <li>
                                <a href="{{ route('termsAndConditions') }}" target="_blank">Terms & Conditions</a>
                            </li>
                            <li>
                                <a href="{{ route('privacyPolicy') }}" target="_blank">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-4 text-right pad-res">
                        <ul class="social-links">
                            <li>
                                <a href="" target="_blank" id="fbShare">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="" target="_blank" id="twitterShare">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="" target="_blank" id="waShare">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        const socialInvitation = "{{ getSetting('SOCIAL_INVITATION') }}";
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        function logoutControl($email)
        {
            let form = new FormData();
            form.append("user_email", $email);
            $.ajax({
                    url: "/logout_control",
                    data: form,
                    type: "post",
                    cache: true,
                    contentType: false,
                    processData: false,
                })
                .done(function(data) {
                    data = JSON.parse(data);
                    if(data.success)
                    {
                        document.getElementById('logout-form').submit();    
                    }
                    else {
                        alert('this is authentication error');
                    }
                })
                .catch(function() {
                    showErrorAlert();
                    $("#video").attr("disabled", false);
                });
        }
    </script>
    @yield('script')
</body>

</html>
