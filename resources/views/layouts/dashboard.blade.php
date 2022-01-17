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
    @yield('style')
</head>

<body style="overflow: hidden;">
    <div id="app">
        <div class="loader loader--style1">
            <div class="row loader-row">
                <i class="fa fa-spinner"></i>
            </div>
        </div>
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
                        <span class="nav-link">
                            <div class="row">
                                @guest
                                @else
                                <button id="camera_btn" class="pagelinks btn btn-theme active" onclick="openPage(event, 'camera')" title="Video chat" >
                                    <i class="fa fa-video"></i>
                                    <span class="d-none d-lg-inline-block">Video</span>
                                </button>
                                <button id="text_btn" class="pagelinks btn btn-theme ml-2" onclick="openPage(event, 'text')" title="Text chat" >
                                    <i class="fa fa-comments"></i>
                                    <span class="d-none d-lg-inline-block">Text</span>
                                </button>
                                    @if (Auth::user()->gender == 'woman')
                                    <button id="record_video_btn" class="pagelinks btn btn-theme ml-2" onclick="openPage(event, 'record_video')" title="Record Video" >
                                        <i class="fa fa-comments"></i>
                                        <span class="d-none d-lg-inline-block">Record Video</span>
                                    </button>
                                    @elseif(Auth::user()->gender == 'man')
                                    <button id="view_stories_btn" class="pagelinks btn btn-theme ml-2" onclick="openPage(event, 'view_stories')" title="View Stories" >
                                        <i class="fa fa-comments"></i>
                                        <span class="d-none d-lg-inline-block">View Stories</span>
                                    </button>    
                                    @endif
                                @endguest
                                
                                @if (Auth::check() && Auth::user()->gender == 'woman')
                                <a class="nav-link" id="points" style="cursor: pointer;"  data-target="#withdrawModal" data-toggle="modal" onclick="getWomenPoints()">{{Auth::user()->points}}</a>
                                @endif
                            </div>
                        </span>
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
                                <a class="nav-link" href="{{ route('register') }}"><button class="btn btn-theme">{{ __('Join Now') }}</button></a>
                            </li>
                        @endif
                    @else
                        @if (getSetting('AUTH_MODE') == 'enabled' && getSetting('PAYMENT_MODE') == 'enabled' && Auth::user()->gender == 'man')
                            <li>
                                <div class="dropdown">
                                  <button class="dropbtn">Buy</button>
                                  <div class="dropdown-content">
                                     <h3 class="text-center" style="color:white" id="timer">{{round((Auth::user()->points)/60)}}</h3>  
                                    
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
                        @guest
                        @else
                        <li class="nav-item view_requests_li">
                            <a class="friend-request-dropdown" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus icon-light stroke-width-3 iw-16 ih-16"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-friend-request dropdown_menu-6 " style="display: none;" id="pop-up-menu">
                                
                            </div>
                        </li>
                        @endguest
                        <li class="nav-item onlineCount">
                            <span id="onlineCount">X</span>
                            <span>online users</span>
                        </li>
                        <li class="nav-item">
                            <li>
                                <a class="message-dropdown" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle icon-light stroke-width-3 iw-16 ih-16"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                    <span class="count success">2</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-recent-message dropdown_menu-6 " style="display: none;">
                                    <div class="dropdown-header">
                                        <div class="left-title">
                                            <span>messages</span>
                                        </div>
                                    </div>
                                    <div class="dropdown-content">
                                        <ul class="friend-list ">
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('storage/images/user_photos/1mkbxjXwO73apmFl6yiJB6sXe0sWnh56YmzqWeNY.jpg') }}" alt="user" data-xblocker="passed" style="visibility: visible;">
                                                        <div class="media-body">
                                                            <div>
                                                                <p class="mt-0">Paige Turner</p>
                                                                <p>Are you there ?</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="active-status">
                                                        <span class="active"></span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('storage/images/user_photos/1mkbxjXwO73apmFl6yiJB6sXe0sWnh56YmzqWeNY.jpg') }}" alt="user" data-xblocker="passed" style="visibility: visible;">
                                                        <div class="media-body">
                                                            <div>
                                                                <p class="mt-0">Bob Frapples</p>
                                                                <p>hello ! how are you ?</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="active-status">
                                                        <span class="offline"></span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="theme-switch-wrapper">
                                    <a class="dark-theme-setting" title="Toggle dark mode">
                                        <svg id="themeSwitch" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-moon icon-light stroke-width-3 iw-16 ih-16"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                                    </a>
                                </div>
                            </li>    
                            <li>
                                <a class="announcement-dropdown" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell icon-light stroke-width-3 iw-16 ih-16"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class="count warning">2</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-announcement dropdown_menu-6 " style="display: none;">
                                    <div class="dropdown-header">
                                        <span>Notification</span>
                                    </div>
                                    <div class="dropdown-content">
                                        <ul class="friend-list">
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('storage/images/user_photos/1mkbxjXwO73apmFl6yiJB6sXe0sWnh56YmzqWeNY.jpg') }}" alt="user" data-xblocker="passed" style="visibility: visible;">
                                                        <div class="media-body">
                                                            <div>
                                                                <p class="mt-0"><span>Bob Frapples</span> add their stories</p>
                                                                <p>8 hour ago</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('storage/images/user_photos/1mkbxjXwO73apmFl6yiJB6sXe0sWnh56YmzqWeNY.jpg') }}" alt="user" data-xblocker="passed" style="visibility: visible;">
                                                        <div class="media-body">
                                                            <div>
                                                                <p class="mt-0"><span>Josephin water</span> have birthdaytoday</p>
                                                                <p>sun at 5.55 AM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="media">
                                                        <img src="{{asset('storage/images/user_photos/1mkbxjXwO73apmFl6yiJB6sXe0sWnh56YmzqWeNY.jpg') }}" alt="user" data-xblocker="passed" style="visibility: visible;">
                                                        <div class="media-body">
                                                            <div>
                                                                <p class="mt-0"><span>Petey Cruiser</span> added a new photo</p>
                                                                <p>sun at 5.40 AM</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            
                        </li>
                        
                        
                        
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

        <main class="mb-md-0">
            @yield('content')
        </main>

        <footer class="dashboard-footer">
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
        $(".dropbtn").on('click', function() {
           $(".dropbtn").backgroundColor = 'white';
        });
        function displayDollar($dollars) {
            //setInterval(function(){
            $('#points').html('$' + $dollars/100);
            //}, 1000);
        }
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
