<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('assets/images/favicon.png')); ?>">
    <title><?php echo e(getSetting('APPLICATION_NAME')); ?></title>
    <!-- Styles -->
    <style type="text/css">
        :root {
            --primary-color: <?php echo e(getSetting('THEME_COLOR')); ?>;
        }
    </style>
    <script>
        //set the initial theme
        const currentTheme = localStorage.getItem('theme') || "<?php echo e(getSetting('DEFAULT_THEME')); ?>";
        if (currentTheme) document.documentElement.setAttribute('data-theme', currentTheme);
    </script>
    <link href="<?php echo e(asset('css/app.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/fa.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/toastr.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/sweetalert2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/home_extra.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/bootstrap-fileinput.css')); ?>" rel="stylesheet">
    <!-- Theme css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
<style>
.messanger-section .chat-content .tab-box .user-chat .chat-history .avenue-messenger .chat .messages-content .message {
    min-width: 82px;    
}

.messanger-section .chat-content .tab-box .user-chat .chat-history .avenue-messenger .chat .messages-content .message .contact_avatar {
    width: 100px;
    margin: 0 2px;
    height: 100px;
}
.message-box .btn-info {
    padding: 5px;
    margin-right: 10px;
}
</style>
<style>
    :root {
    --white-bg: #fff;
    --card-bg: #fff;
    --font-color: #1d253b;
    --bg-color: #f5f6fa;
    --box-shadow-color: #838384;
    --borderbox-color: #efefef;
    --btn-font: #ffffff;
    --border-color: #c5c5c5;
}

[data-theme="dark"] {
    --white-bg: #27293d;
    --card-bg: #e2e4e9;
    --font-color: #fff;
    --bg-color: #1e1e2d;
    --border-color: #3d3d46;
    --box-shadow-color: #292943;
    --btn-font: #ffffff;
    --borderbox-color: #33354e;
}
.btn-theme {
    border: 0;
    color: var(--btn-font);
    position: relative;
    font-weight: 400;
    background: var(--primary-color);
    z-index: 0;
}
.hide {
    display: none;
}
</style>
    <!--Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    
</head>

<body>
    <!-- loader start -->
    <div class="pre-loader">
        <header>
            <div class="mobile-fix-menu"></div>
            <div class="container-fluid custom-padding">
                <div class="header-section">
                    <div class="header-left">
                        <div class="brand-logo">
                            <a href="<?php echo e(url('/')); ?>">
                                <img src="<?php echo e(asset('assets/images/icon/logo.png')); ?>" alt="logo" class="img-fluid blur-up lazyload">
                            </a>
                        </div>
                    </div>
                    <div class="header-right">
                        <div class="post-stats">
                            <ul>
                                <li>
                                    <img id="" src="" alt="Country Flag" width="25" class="mr-2" hidden />
                                </li>
                                <li>
                                    <a href="#">
                                        <h3>X</h3>
                                        <span>online users</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <ul class="option-list">
                            <!-- add friend -->
                            <li class="header-btn custom-dropdown dropdown-lg add-friend">
                                <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="user-plus"></i>
                                </a>
                            </li>
                            <!-- message -->
                            <li class="header-btn custom-dropdown dropdown-lg btn-group message-btn">
                                <a class="main-link" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="message-circle"></i>
                                </a>
                            </li>
                            <!-- dark/light -->
                            <li class="header-btn custom-dropdown">
                                <a class="main-link" href="javascript:void(0)">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="moon"></i>
                                </a>
                                <a class="main-link d-none" href="javascript:void(0)">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="sun"></i>
                                </a>
                            </li>
                            <!-- mobile app button -->
                            <li class="header-btn custom-dropdown d-md-none d-block app-btn">
                                <a class="main-link" href="javascript:void(0)">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="grid"></i>
                                </a>
                                <div class="overlay-bg app-overlay"></div>
                                <div class="app-box">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="index.html">
                                                    <div class="icon">
                                                        <i data-feather="file" class="bar-icon"></i>
                                                    </div>
                                                    <h5>Newsfeed</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="single-page.html">
                                                    <div class="icon">
                                                        <i data-feather="star" class="bar-icon"></i>
                                                    </div>
                                                    <h5>favourite</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="#">
                                                    <div class="icon">
                                                        <i data-feather="users" class="bar-icon"></i>
                                                    </div>
                                                    <h5>group</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="music.html">
                                                    <div class="icon">
                                                        <i data-feather="headphones" class="bar-icon"></i>
                                                    </div>
                                                    <h5>music</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="weather.html">
                                                    <div class="icon">
                                                        <i data-feather="cloud" class="bar-icon"></i>
                                                    </div>
                                                    <h5>weather</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="event.html">
                                                    <div class="icon">
                                                        <i data-feather="calendar" class="bar-icon"></i>
                                                    </div>
                                                    <h5>calender</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="#">
                                                    <div class="icon">
                                                        <svg class="bar-icon">
                                                            <use class="fill-color"
                                                                xlink:href="../assets/svg/icons.svg#cake"></use>
                                                        </svg>
                                                    </div>
                                                    <h5>event</h5>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="app-icon">
                                                <a href="games.html">
                                                    <div class="icon">
                                                        <svg class="bar-icon">
                                                            <use class="fill-color"
                                                                xlink:href="../assets/svg/icons.svg#game-controller">
                                                            </use>
                                                        </svg>
                                                    </div>
                                                    <h5>games</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- notification -->
                            <li class="header-btn custom-dropdown dropdown-lg btn-group notification-btn">
                                <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="bell"></i>
                                </a>
                            </li>
                            <!-- profile -->
                            <li class="header-btn custom-dropdown profile-btn btn-group">
                                <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-light stroke-width-3 d-sm-none d-block iw-16 ih-16" data-feather="user"></i>
                                    <div class="media d-none d-sm-flex">
                                        <div class="user-img">
                                            <img src="<?php echo e(asset('storage/images/user_photos/' . $avatar['avatar_name'])); ?>" class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                        <div class="media-body d-none d-md-block">
                                            <h4><?php echo e(Auth::user()->username); ?></h4>
                                            <span>active now</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        
    </div>
    <!-- loader end -->
    <!-- header start -->
    <header>
        <div class="mobile-fix-menu"></div>
        <div class="container-fluid custom-padding">
            <div class="header-section">
                <div class="header-left">
                    <div class="brand-logo">
                        <a onclick="openPage(event, 'camera')">
                            <img src="<?php echo e(asset('assets/images/icon/logo.png')); ?>" alt="logo" class="img-fluid blur-up lazyload">
                        </a>
                    </div>
                </div>
                <div class="header-right">
                    <div class="post-stats">
                        <ul>
                            <li>
                                <img id="selfCountryflag" src="" alt="Country Flag" width="25" class="mr-2" hidden />
                            </li>
                            <li>
                                <a href="#">
                                    <h3 id="onlineCount">X</h3>
                                    <span>online users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <ul class="option-list">
                        <!-- add friend -->
                        <li class="header-btn custom-dropdown dropdown-lg add-friend">
                            <a class="main-link friend_request_link" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="user-plus"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right ">
                                <div class="dropdown-header">
                                    <span>friend request</span>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list friend_request_dropdown">
                                        
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- message -->
                        <li class="header-btn custom-dropdown dropdown-lg btn-group message-btn">
                            <a class="main-link unread_message_link" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="message-circle"></i>
                                <div id="unread_message_counter"></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <div class="left-title">
                                        <span>messages</span>
                                    </div>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list unread_message_dropdown ">
                                        
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- dark/light -->
                        <!--<li class="header-btn custom-dropdown">-->
                        <!--    <a class="main-link dark-theme-setting" id="themeSwitch">-->
                        <!--        <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="moon"></i>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="header-btn custom-dropdown">
                            <a id="dark" class="main-link" href="javascript:void(0)">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="moon"></i>
                            </a>
                            <a id="light" class="main-link d-none" href="javascript:void(0)">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="sun"></i>
                            </a>
                        </li>
                        <!-- mobile app button -->
                        <li class="header-btn custom-dropdown d-md-none d-block app-btn">
                            <a class="main-link" href="javascript:void(0)">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="grid"></i>
                            </a>
                            <div class="overlay-bg app-overlay"></div>
                            <div class="app-box">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="index.html">
                                                <div class="icon">
                                                    <i data-feather="file" class="bar-icon"></i>
                                                </div>
                                                <h5>Newsfeed</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="single-page.html">
                                                <div class="icon">
                                                    <i data-feather="star" class="bar-icon"></i>
                                                </div>
                                                <h5>favourite</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="#">
                                                <div class="icon">
                                                    <i data-feather="users" class="bar-icon"></i>
                                                </div>
                                                <h5>group</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="music.html">
                                                <div class="icon">
                                                    <i data-feather="headphones" class="bar-icon"></i>
                                                </div>
                                                <h5>music</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="weather.html">
                                                <div class="icon">
                                                    <i data-feather="cloud" class="bar-icon"></i>
                                                </div>
                                                <h5>weather</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="event.html">
                                                <div class="icon">
                                                    <i data-feather="calendar" class="bar-icon"></i>
                                                </div>
                                                <h5>calender</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="#">
                                                <div class="icon">
                                                    <svg class="bar-icon">
                                                        <use class="fill-color"
                                                            xlink:href="../assets/svg/icons.svg#cake"></use>
                                                    </svg>
                                                </div>
                                                <h5>event</h5>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="app-icon">
                                            <a href="games.html">
                                                <div class="icon">
                                                    <svg class="bar-icon">
                                                        <use class="fill-color"
                                                            xlink:href="../assets/svg/icons.svg#game-controller">
                                                        </use>
                                                    </svg>
                                                </div>
                                                <h5>games</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- notification -->
                        <li class="header-btn custom-dropdown dropdown-lg btn-group notification-btn">
                            <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="bell"></i>
                                <span class="count warning">4</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <span>Notification</span>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list">
                                        <li class="d-block">
                                            <div>
                                                <div class="media">
                                                    <img src="<?php echo e(asset('assets/images/user-sm/5.jpg')); ?>" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0"><span>Paige Turner</span> send you a friend
                                                                request
                                                            </h5>
                                                            <h6> 1 mutual friend</h6>
                                                            <div class="action-btns">
                                                                <button type="button" class="btn btn-solid"><i
                                                                        data-feather="check"></i></button>
                                                                <button type="button" class="btn btn-solid ms-1"><i
                                                                        data-feather="x"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="<?php echo e(asset('assets/images/user-sm/6.jpg')); ?>" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0"><span>Bob Frapples</span> add their stories
                                                            </h5>
                                                            <h6>8 hour ago</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="<?php echo e(asset('assets/images/user-sm/7.jpg')); ?>" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0"><span>Josephin water</span> have birthday
                                                                today
                                                            </h5>
                                                            <h6>sun at 5.55 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="<?php echo e(asset('assets/images/user-sm/2.jpg')); ?>" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0"><span>Petey Cruiser</span> added a new
                                                                photo
                                                            </h5>
                                                            <h6>sun at 5.40 AM</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- profile -->
                        <li class="header-btn custom-dropdown profile-btn btn-group">
                            <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-light stroke-width-3 d-sm-none d-block iw-16 ih-16"
                                    data-feather="user"></i>
                                <div class="media d-none d-sm-flex">
                                    <div class="user-img">
                                        <img src="<?php echo e(asset('storage/images/user_photos/' . $avatar['avatar_name'])); ?>" class="img-fluid blur-up lazyload bg-img" alt="user">
                                        <span class="available-stats online"></span>
                                    </div>
                                    <div class="media-body d-none d-md-block">
                                        <h4><?php echo e(Auth::user()->username); ?></h4>
                                        <span>active now</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <span>profile</span>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list">
                                        <li>
                                            <a href="<?php echo e(route('profile')); ?>">
                                                <div class="media">
                                                    <i data-feather="user"></i>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Profile</h5>
                                                            <h6>Profile preview & settings</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <div class="media">
                                                    <i data-feather="settings"></i>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">setting & privacy</h5>
                                                            <h6>all settings & privacy</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <div class="media">
                                                    <i data-feather="help-circle"></i>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">help & support</h5>
                                                            <h6>browse help here</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a onclick="logoutControl('<?php echo e(Auth::user()->email); ?>'); event.preventDefault();">
                                                <div class="media">
                                                    <i data-feather="log-out"></i>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">log out</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
            
                                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->
    <div id="camera" class="pagecontent">
        <section class="dashboard">
        <div id="permission"></div>
        <canvas id="canvas" class="hide"></canvas>
        <div class="container-fluid main video-dask">
            <div class="row">
                <?php if(getFeature('VIDEO_CHAT', 'status') == 'active'): ?>
                    <div class="col-12 col-md-4 col-lg-3 video-section pr-0">
                        <div class="remote-video-container">
                            <div class="remote-user-info hide">
                                <img id="partnerCountryVideo" src="" alt="Country Flag" width="25" />
                                <span id="partnerName"></span>
                                <p style="margin-bottom: 0px;" id="capture_timer"></p>
                            </div>
                            <button class="action-video report hide" data-toggle="tooltip" data-placement="top" title="Report">
                                <i class="fa fa-flag"></i>
                            </button>    
                            <video id="remoteVideo" autoplay playsinline></video>
                            <i class="fa fa-video video-load-icon"></i>
                        </div>
                        <div class="local-video-container">
                            <video id="localVideo_m" muted autoplay playsinline></video>
                            <i class="fa fa-video video-load-icon"></i>
                            <div class="video-actions">
                                <button class="action-video video-off" data-toggle="tooltip" data-placement="top"
                                    title="Camera Off"><i class="fa fa-video"></i></button>
                                <button class="action-video hide video-on" data-toggle="tooltip" data-placement="top"
                                    title="Camera On"><i class="fa fa-video-slash"></i></button>
                                <button class="action-video audio-mute" data-toggle="tooltip" data-placement="top"
                                    title="Mute Audio"><i class="fa fa-microphone"></i></button>
                                <button class="action-video hide audio-unmute" data-toggle="tooltip" data-placement="top"
                                    title="Unmute Audio"><i class="fa fa-microphone-slash"></i></button>
                                <button class="action-video rotate" data-toggle="tooltip" data-placement="top"
                                    title="Rotate Camera"><i class="fa fa-camera"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-12 <?php echo e(getFeature('VIDEO_CHAT', 'status') == 'active' ? 'col-md-8 col-lg-9' : 'col-md-12 col-lg-12 text-chat-panel'); ?> chat-main">
                    <div class="row d-flex align-items-center">
                        <!-- call button options :: start -->
                        <div class="col-12 text-center chat-section">
                            <div class="btn-actions">
                                <div class="row align-items-center">
                                    <div class="col-8 col-md-4 col-lg-5 pr-0 text-left">
                                        <span class="mb-0 mt-0">
                                            <img id="partnerCountryText" class="d-none mr-1" src="images/globe.png"
                                                alt="Country Flag" width="25" />
                                        </span>
                                        <?php if(auth()->guard()->guest()): ?>
                                        <?php else: ?>
                                            <?php if(getFeature('VIDEO_CHAT', 'status') == 'active' && Auth::user()->video_chat == 'allow'): ?>
                                                <?php if(Auth::user()->gender == 'woman' && Auth::user()->verify != 'verified'): ?>
                                                    <button class="btn btn-theme" title="Video chat" disabled>
                                                        <i class="fa fa-video"></i>
                                                        <span class="d-none d-lg-inline-block">Start</span>
                                                    </button>
                                                <?php else: ?>
                                                    <button id="video" class="btn btn-theme" title="Video chat">
                                                        <i class="fa fa-video"></i>
                                                        <span class="d-none d-lg-inline-block">Start</span>
                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <button id="stop" class="btn btn-theme hide" title="Stop this chat">
                                            <i class="fa fa-stop"></i>
                                            <span class="d-none d-lg-inline-block">Stop</span>
                                        </button>
                                        <button id="next" class="btn btn-theme hide search-next" title="Search for a new friend">
                                            <i class="fa fa-random"></i>
                                            <span class="d-none d-lg-inline-block">Next</span>
                                        </button>
                                        <button id="add_friend" class="btn btn-theme hide add-friend" title="Add this user as friend">
                                            <i class="fa fa-plus"></i>
                                            <span class="d-none d-lg-inline-block">Add</span>
                                        </button>
                                    </div>
                                    
                                    <div class="col-4 col-md-8 col-lg-7 pl-0 text-right filter-options">
                                        <?php if(getFeature('COUNTRY_FILTER', 'status') == 'active'): ?>
                                            <label class="ml-2 mb-0"><i class="fa fa-flag"></i></label>
                                            <select id="countryFilter">
                                                <option value="">Country: All</option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->code); ?>">
                                                        <?php echo e($country->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        <?php else: ?>
                                            <select id="countryFilter" hidden></select>
                                        <?php endif; ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- call button options :: end -->
        
                        <!-- chat area :: start -->
                        <div class="col-12 chat-area">
                            <!-- about us  :: start -->
                            <div class="about camera-about">
                                <?php if(auth()->guard()->guest()): ?>
                                <?php else: ?>
                                <?php if( Auth::user()->gender == 'woman' && (Auth::user()->verify == 'verified') || Auth::user()->gender == 'man'): ?>
                                <h4 class="recently-chat-history">Recent Chat History<button class="btn btn-danger ml-3 " onclick="videohalldelete()"><i class="fa fa-ban mr-1"></i>Delete All</button></h4> 
                                
                                <ul class="video-history" id="video_history">
                                </ul>
                                <?php endif; ?>
                                <div id="verify_plan_btn" class="mt-5">
                                    <?php if( Auth::user()->gender == 'woman' && (Auth::user()->verify == 'none')): ?>
                                        <p>Please <strong class="text-danger">verify</strong> with three photo to use this app</p>
                                        <button class="btn btn-primary" data-target="#verify_modal" data-toggle="modal" onclick="getWomenPhotoes ()">Verify</button>
                                    <?php elseif( Auth::user()->gender == 'woman' && (Auth::user()->verify == 'uploaded')): ?>
                                        <p>Your three photo is already uploaded. If you want to update, please click this <strong class="text-danger">update</strong> button.</p>
                                        <button class="btn btn-primary" data-target="#verify_modal" data-toggle="modal" onclick="getWomenPhotoes ()">Update</button>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <!-- about us  :: end -->
                            <!-- chat panel :: starts -->
                            <div class="chat-panel hide">
                                <div class="chat-box">
                                    <div class="chat-body video-chat-body"></div>
                                    <div class="chat-footer">
                                        <form id="chatForm">
                                            <div class="input-group">
                                                <input type="text" id="messageInput" class="form-control note-input"
                                                    placeholder="Type a message..." autocomplete="off" maxlength="100"
                                                    disabled />
                                                <div class="input-group-append">
                                                    <button id="send" class="btn btn-outline-secondary" type="submit"
                                                        title="Send" disabled>
                                                        <i class="far fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- chat panel :: end -->
                        </div>
                        <!-- chat area :: end -->
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
    <div id="text"   class="pagecontent"  style="display:none">
        <!-- messanger section start -->
        <section class="messanger-section">
            <div class="chat-users">
                <style>
                    #text .messanger-section .header-btn {
                        position: relative;
                    }
                    #text .messanger-section .header-btn .main-link {
                        padding: 0 15px;
                        display: block;
                        line-height: 1;
                    }
                    #text .messanger-section .header-btn .filter_contact_link {
                        padding: 32px;
                        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                        border-right: 1px solid rgba(0, 0, 0, 0.05);
                    }
                    #text .messanger-section .header-btn .dropdown-menu {
                        min-width: 100%;
                        top: 0px !important;
                    }
                    #text .messanger-section .header-btn .dropdown-menu ul {
                        list-style-type: none;
                        width: 100%;
                    }
                    #text .messanger-section .header-btn .dropdown-menu ul li {
                        padding: 20px;
                        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                    }
                    #text .messanger-section .header-btn .dropdown-menu ul li:last-child {
                        border-bottom: none;
                    }
                    #text .messanger-section #myTab {
                        border-right: 1px solid rgba(0, 0, 0, 0.05);
                    }
                    #messages-content {
                        overflow-x: hidden;
                    }
                    /*for contact online status*/
                    #myTab .nav-item .nav-link .story-img .available-stats.online {
                        background-color: #2bc60c;
                    }
                    #myTab .nav-item .nav-link .story-img .available-stats {
                        position: absolute;
                        right: 0;
                        top: 0;
                        width: 12px;
                        height: 12px;
                        border: 3px solid #ffffff;
                        border-radius: 100%;
                    }
                </style>

                <ul class="nav nav-tabs" id="myTab" role="tablist" style="flex-direction: column;">
                    
                </ul>
            </div>
                <style>
                    #text .messanger-section .chat-content .tab-content .user-title .dropdown-menu {
                        top: 30px !important;
                    }
                    #text .messanger-section .chat-content .tab-box .user-chat .chat-history .avenue-messenger .chat .messages-content .message img {
                        width: 100%;
                    }
                    #text .messanger-section .chat-content .tab-content .user-title .dropdown-menu ul {
                        list-style-type: none;
                        display: flex;
                        flex-direction: column;
                    }
                    
                    #text .messanger-section .chat-content .tab-content .user-title {
                        justify-content: space-between;
                    }
                    
                    #text .messanger-section .chat-content .tab-content .user-title ul {
                        display: flex;
                    }
                    
                    #text .messanger-section .chat-content .tab-content .user-title ul li{
                        padding: 5px 10px;
                    }
                    .gift {
                        margin: 10px;
                        padding: 10px 5px 5px;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        width: 120px;  
                    }
                    .send-gift {
                        margin: 10px;
                        padding: 10px 5px 5px;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        width: 120px;
                    }
                    .gift:hover {
                        cursor: pointer;
                        box-shadow: 5px 10px 18px #4335b1;
                    }
                    .gifts-images {
                        border-radius: 10px;
                    }
                    #text .messanger-section .chat-content .tab-content .user-title .dropdown-menu .gift-field {
                        
                        flex-direction: row;
                        flex-wrap: nowrap;
                    }
                </style>
            <div class="chat-content">
                <div class="tab-content" id="myTabContent">
                    <img class="" src="storage/images/source_img/chat_home.png">
                </div>
            </div>
        </section>
        <!-- messanger section end -->
    </div>
<!-- verify modal starts -->
    <div class="modal fade" id="verify_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noticeModalLabel">Verify Photo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="verifyPhotoform">
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label> First question:</label>
                            <label> First question First question First question</label>
                            <input type="file" id="firstphoto" value="$firstphoto->value" class="form-control" >
                        </div> 
                        <div class="col-sm-4">
                            <label>Preview</label>
                            <div class="preview" id="photo1">
                            </div>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Second question:</label>
                            <label> Second question Second question Second question </label>
                            <input type="file" id="secondphoto" value="$secondphoto->value" class="form-control" >
                        </div>
                        <div class="col-sm-4">
                            <label>Preview</label>
                            <div class="preview" id="photo2">
                            </div>
                        </div>
                    </div>
                     
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label>Third question:</label>
                            <label> Third question Third question Third question </label>
                            <input type="file" id="thirdphoto" value="$thirdphoto->value" class="form-control" >
                        </div>
                        <div class="col-sm-4">
                            <label>Preview</label>
                            <div class="preview" id="photo3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="savephoto" class="btn btn-primary">Save Photo</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <!-- verify modal ends -->
    <!-- withdraw modal starts -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Withdraws</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <h4 class="text-center">
                        You have <strong style="color: pink" id="woman_points"></strong> points.
                    </h4>
                    <div id="alertplace"></div>
                    <div class="form-group">
                        <div class="tab">
                            <button id="visa_btn" class="tablinks active" onclick="openPayment(event, 'visa')">
                                <img src="<?php echo e(asset('storage/images/source_img/visaicon.png')); ?>" width="110" height="40" alt="visa">
                            </button>
                            
                            <button id="paypal_btn" class="tablinks" onclick="openPayment(event, 'paypal')">
                                <img src="<?php echo e(asset('storage/images/source_img/paypalicon.png')); ?>" width="45" height="40" alt="paypal">aypal
                            </button>
                        </div>
                        <div id="visa" class="tabcontent" style="display:block">
                            <form id="visaForm">
                                <label class="col-md-4 col-form-label">Account Name</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="account_name" required >
                                </div>
        
                                <label class="col-md-4 col-form-label">BSB Number</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control card-number" id="bsb_number" min="0" size="20"  required>
                                </div>
                                
                                <label class="col-md-4 col-form-label">Account Number</label>
                                <div class="col-md-12">
                                    <input type="number" class="form-control card-number" id="account_number" min="0" size="20"  required>
                                </div>
                                <div class="row m-3 d-flex justify-content-end">
                                    <button type="submit" id="visawithdraw" class="btn btn-theme"> Withdraw </button>
                                </div>
                            </form>
                        </div>
                        
                        <div id="paypal" class="tabcontent">
                            <form id="paypalForm">
                                <label class="col-md-4 col-form-label">Paypal email</label>
                                <div class="col-md-12">
                                    <input type="email" class="form-control" id="paypal_email" required>
                                </div>
                                <div class="row m-3 d-flex justify-content-end">
                                    <button type="submit" id="paypalwithdraw" class="btn btn-theme"> Withdraw </button>    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- withdraw modal ends -->
    <!-- withdraw success modal starts -->
    <div class="modal fade" id="withdrawSuccessModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Welcome</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body terms_modal">
                    <h6 class="m-3" style="color: <?php echo e(getSetting('THEME_COLOR')); ?>">Thank you, admin will review and send the money in 3 bussiness days</h6>        
                </div>
                <div class="modal-footer">
                    <button type="submit" id="ok-btn" class="btn btn-theme">Ok</button>
                </div>
                
            </div>
        </div>
    </div>
    <!-- withdraw success modal ends -->
    <!-- contact request modal starts -->
    <div class="modal fade" id="contactRequestModal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Friend Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-center" id="contact_request_avatar">
                        
                    </div>
                    <div class="row d-flex justify-content-center">
                        <h5 id="request_self_username"></h5>
                        <input type="hidden" id="request_self_email">
                        <input type="hidden" id="request_partner_email">
                    </div>
                    <div class="row d-flex justify-content-center mt-3">
                        <button type="button" class="btn btn-warning decline_request_btn">Decline</button>   
                        <button type="button" class="btn btn-primary ml-3 accept_request_btn">Accept</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- contact request modal ends -->
    <!-- translate modal starts -->
    <div class="modal fade" id="translate_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="top: -250px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Translate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="translateForm">
                    <div class="modal-body">
                        <select id="languageFilter" class="form-control">
                            <option value="">Select Language</option>
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($language->lang_code); ?>">
                                    <?php echo e($language->lang_name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="trans_modal_cancel" class="btn btn-theme">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- translate modal ends -->
    <!-- upload photo modal starts -->
    <div class="modal fade" id="upload_photo_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Upload photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="uploadPhotoForm">
                    <div class="modal-body">
                        <div class="form-group d-flex flex-column align-items-center">
                            <h3>Upload photo</h3>
                            <p>File should not be bigger than 5MB</p>
                            <div class="fileinput fileinput-new" data-provides="fileinput" style="width: 60%;">
            					<div class="fileinput-new thumbnail" style="width: 100%; height: 100%;">
            						<img class="verifyphoto" src="storage/images/user_photos/stranger.jpg" alt="" >
            					</div>
            					<div class="fileinput-preview fileinput-exists thumbnail" style="width: 100%; height: 100%;">
            					</div>
            					<div>
            						<span class="btn default btn-file">
            							<span class="fileinput-new btn btn-primary">Select image </span>
            							<span class="fileinput-exists btn btn-warning">	Change </span>
            							<input type="file" name="..." id="uploadimage">
            						</span>
            						<a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove </a>
            					</div>
            				</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="uploadphotostart" class="btn btn-theme">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- upload photo modal ends -->
    <!-- take photo modal starts -->
    <div class="modal fade" id="take_photo_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Take photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="takePhotoForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" id="photo_id">
                            <div class="local-video-container" id="local-video-container">
                                <div id="preview_video_part" class="preview-photo round-10 ">
                                    <video id="localVideo" muted autoplay playsinline></video>
                                </div>
                                <div id="preview_photo_part" class="preview-photo round-10 ">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-theme take-photo ">Take a photo</button>
                        <div class="take-photo-hide " id="two_method" >
                            <button type="submit" id="photo_send_start" class="btn btn-theme mr-3 ">Send</button>
                            <button type="button" id="photo_take_another" class="btn btn-theme">Take another</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- take photo modal ends -->
    <!-- view photo modal starts -->
    <div class="modal fade" id="view_photo_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 678px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">View photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="view_photo"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="photo_view_close" class="btn btn-theme mr-3">close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- view photo modal ends -->
    
    <!-- take video modal starts -->
    <div class="modal fade" id="take_video_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Video Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="takeVideoForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <h5 id="record_timer">Minimum video length is 5 seconds</h5>
                            <div class="local-video-container">
                                <div id="preview_record1_part" class="preview-photo round-10 ">
                                    <video id="localVideo1" muted autoplay playsinline></video>
                                    <div class="video-actions" id="take-video-actions">
                                        <button class="action-video video-off" data-toggle="tooltip" data-placement="top"  title="Camera Off"><i class="fa fa-video"></i></button>
                                        <button class="action-video hide video-on" data-toggle="tooltip" data-placement="top"  title="Camera On"><i class="fa fa-video-slash"></i></button>
                                        <button class="action-video audio-mute" data-toggle="tooltip" data-placement="top" title="Mute Audio"><i class="fa fa-microphone"></i></button>
                                        <button class="action-video hide audio-unmute" data-toggle="tooltip" data-placement="top" title="Unmute Audio"><i class="fa fa-microphone-slash"></i></button>
                                        <button class="action-video rotate" data-toggle="tooltip" data-placement="top" title="Rotate Camera"><i class="fa fa-camera"></i></button>
                                    </div>
                                </div>
                                <div id="preview_record2_part" class="preview-photo round-10 ">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-theme take-video-start ">Start Recording</button>
                        <button type="button" class="btn btn-theme take-video-stop take-photo-hide ">Stop Recording</button>
                        <div class="take-photo-hide " id="two_video_method" >
                            <button type="button" id="video_send_start" class="btn btn-theme mr-3 ">Send</button>
                            <button type="button" id="video_take_another" class="btn btn-theme">Take another</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- take video modal ends -->
    <!-- clear history modal starts -->
    <div class="modal fade" id="clear_history_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Confirm clearing your chat history!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="clearChatHistoryForm">
                    <div class="modal-body">
                        <img class="contact_avatar" src="storage/images/source_img/chat_history_clear.png" >    
                        <p>Confirm clearing your chat history!</p>
                        <div class="form-group">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="clear_start" class="btn btn-theme">Confirm</button>
                        <button type="button" id="clear_cancel" class="btn btn-theme">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- clear history modal ends -->
    <!-- delete partner modal starts -->
    <div class="modal fade" id="delete_partner_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Confirm chat partner deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deletePartnerForm">
                    <div class="modal-body">
                        <div style="margin:auto;" id="delete_contact_avatar">
                            
                        </div>
                        <div class="form-group">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="contact_delete_start" class="btn btn-theme">Confirm</button>
                        <button type="button" id="contact_delete_cancel" class="btn btn-theme">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete partner modal ends -->
    <!-- report modal starts -->
    <div class="modal fade" id="report_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noticeModalLabel">Report a violation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="reportForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="report_avatar"></div>
                            <label>
                                <input type="radio" name="report_radio" value="Spam" checked>  <span>Spam</span>
                            </label><br>
                            <label>
                                <input type="radio" name="report_radio" value="CSS">  <span>Nudity or pornography</span>
                            </label><br>
                            <label>
                                <input type="radio" name="report_radio" value="HTML">  <span>Child endangerment (exploitation)</span>
                            </label><br>
                            <label>
                                <input type="radio" name="report_radio" value="CSS">  <span>Harassment or threats</span>
                            </label><br>
                            <label>
                                <input type="radio" name="report_radio" value="JavaScript">  <span>Deception / Deception for gifts</span>                        
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="report_start" class="btn btn-theme">Confirm</button>
                        <button type="button" id="report_cancel" class="btn btn-theme">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- report modal ends -->
    <!-- direct call modal starts -->
    <div class="modal fade" id="call_offer_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <input type="text" id="parnter_avatar_name">
                    <div class="d-flex justify-content-center" id="call_offer_partner_avatar"></div>
                    <div class="d-flex justify-content-center" id="call_offer_partner_name"></div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" id="call_offer_start" class="btn btn-theme">Call</button>
                    <button type="button" id="call_offer_cancel" class="btn btn-theme">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- direct call  modal ends -->
    <!-- direct call modal starts -->
    <div class="modal fade" id="call_answer_modal" tabindex="-1" role="dialog" aria-labelledby="noticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p>I have a request for calling </p>
                    <input type="text" id="call_from_email">
                    <div class="d-flex justify-content-center" id="call_answer_partner_avatar"></div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" id="call_answer_accept" class="btn btn-theme">Accept</button>
                    <button type="button" id="call_answer_cancel" class="btn btn-theme">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- direct call  modal ends -->
<!--dashboard script begin-->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    
<!--dashboard script end-->
<!-- origin script begin -->
    <script src="<?php echo e(asset('js/socket.io.js')); ?>"></script>
    <script src="<?php echo e(asset('js/adapter.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/home.js')); ?>"></script>
    <script src="<?php echo e(asset('js/home_extra.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-fileinput.js')); ?>"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');  }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
        $(document).ready(function() {
            paintHeaderFriendRequest();
            paintHeaderUnreadMessage();
        });
        function logoutControl(email)
        {
            console.log(email)
            let form = new FormData();
            form.append("user_email", email);
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
<!-- origin script end -->
    <!-- latest jquery-->
    
    <!-- popper js-->
    <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
    <!-- slick slider js -->
    <script src="<?php echo e(asset('assets/js/slick.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom-slick.js')); ?>"></script>
    <!-- counter js -->
    <script src="<?php echo e(asset('assets/js/counter.js')); ?>"></script>
    <!-- popover js for custom popover -->
    <!--<script src="<?php echo e(asset('assets/js/popover.js')); ?>"></script>-->
    <!-- feather icon js-->
    <script src="<?php echo e(asset('assets/js/feather.min.js')); ?>"></script>
    <!-- emoji picker js-->
    <script src="<?php echo e(asset('assets/js/emojionearea.min.js')); ?>"></script>
    <!-- Bootstrap js-->
    <script src="<?php echo e(asset('assets/js/bootstrap.js')); ?>"></script>
    <!-- chatbox js -->
    <!--<script src="<?php echo e(asset('assets/js/chatbox.js')); ?>"></script>-->
    <!-- lazyload js-->
    <script src="<?php echo e(asset('assets/js/lazysizes.min.js')); ?>"></script>
    <!-- theme setting js-->
    <script src="<?php echo e(asset('assets/js/theme-setting.js')); ?>"></script>
    <!-- Theme js-->
    <script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
    <script>
        feather.replace();
        $(".emojiPicker").emojioneArea({
            inline: true,
            placement: 'absleft',
            pickerPosition: "top left",
        });
    </script>
</body>

</html><?php /**PATH /home/admin/fluky/resources/views/home.blade.php ENDPATH**/ ?>