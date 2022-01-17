<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="friendbook">
    <meta name="keywords" content="friendbook">
    <meta name="author" content="friendbook">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon" />
    <title>Friendbook</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.3/jquery.mCustomScrollbar.min.css'>

    <!-- Theme css -->
    <link id="change-link" rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>

<body>

    <!-- loader start -->
    <div class="loading-text">
        <div>
            <h1 class="animate">Loading</h1>
        </div>
    </div>
    <!-- loader end -->


    <!-- header start -->
    <header class="d-none d-sm-block">
        <div class="mobile-fix-menu"></div>
        <div class="container-fluid custom-padding">
            <div class="header-section">
                <div class="header-left">
                    <div class="brand-logo">
                        <a href="index.html">
                            <img src="../assets/images/icon/logo.png" alt="logo" class="img-fluid blur-up lazyload">
                        </a>
                    </div>
                    <div class="search-box">
                        <i data-feather="search" class="icon iw-16 icon-light"></i>
                        <input type="text" class="form-control search-type" placeholder="find friends...">
                        <div class="icon-close">
                            <i data-feather="x" class="iw-16 icon-light"></i>
                        </div>
                        <div class="search-suggestion">
                            <span class="recent">recent search</span>
                            <ul class="friend-list">
                                <li>
                                    <div class="media">
                                        <img src="../assets/images/user-sm/9.jpg" alt="user">
                                        <div class="media-body">
                                            <div>
                                                <h5 class="mt-0">Paige Turner</h5>
                                                <h6> 1 mutual friend</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="../assets/images/user-sm/12.jpg" alt="user">
                                        <div class="media-body">
                                            <div>
                                                <h5 class="mt-0">Paige Turner</h5>
                                                <h6> 1 mutual friend</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="media">
                                        <img src="../assets/images/user-sm/15.jpg" alt="user">
                                        <div class="media-body">
                                            <div>
                                                <h5 class="mt-0">Paige Turner</h5>
                                                <h6> 1 mutual friend</h6>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="btn-group">
                        <!-- home -->
                        <li class="header-btn home-btn">
                            <a class="main-link" href="index.html">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="home"></i>
                            </a>
                        </li>
                        <!-- add friend -->
                        <li class="header-btn custom-dropdown dropdown-lg add-friend">
                            <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="user-plus"></i>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-header">
                                    <span>friend request</span>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list">
                                        <li>
                                            <div class="media">
                                                <img src="../assets/images/user-sm/5.jpg" alt="user">
                                                <div class="media-body">
                                                    <div>
                                                        <h5 class="mt-0">Paige Turner</h5>
                                                        <h6> 1 mutual friend</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-btns">
                                                <button type="button" class="btn btn-solid">confirm</button>
                                                <button type="button" class="btn btn-outline ms-1">delete</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img src="../assets/images/user-sm/6.jpg" alt="user">
                                                <div class="media-body">
                                                    <div>
                                                        <h5 class="mt-0">Paige Turner</h5>
                                                        <h6> 1 mutual friend</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-btns">
                                                <button type="button" class="btn btn-solid">confirm</button>
                                                <button type="button" class="btn btn-outline ms-1">delete</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img src="../assets/images/user-sm/7.jpg" alt="user">
                                                <div class="media-body">
                                                    <div>
                                                        <h5 class="mt-0">Paige Turner</h5>
                                                        <h6> 1 mutual friend</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-btns">
                                                <button type="button" class="btn btn-solid">confirm</button>
                                                <button type="button" class="btn btn-outline ms-1">delete</button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <img src="../assets/images/user-sm/2.jpg" alt="user">
                                                <div class="media-body">
                                                    <div>
                                                        <h5 class="mt-0">Paige Turner</h5>
                                                        <h6> 1 mutual friend</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="action-btns">
                                                <button type="button" class="btn btn-solid">confirm</button>
                                                <button type="button" class="btn btn-outline ms-1">delete</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="header-right">
                    <div class="post-stats">
                        <ul>
                            <li>
                                <h3>326</h3>
                                <span>total posts</span>
                            </li>
                            <li>
                                <h3>2456</h3>
                                <span>total friends</span>
                            </li>
                        </ul>
                    </div>
                    <ul class="option-list">
                        <!-- message -->
                        <li class="header-btn custom-dropdown dropdown-lg btn-group message-btn">
                            <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="message-circle"></i><span
                                    class="count success">2</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header">
                                    <div class="left-title">
                                        <span>messages</span>
                                    </div>
                                    <div class="right-option">
                                        <ul>
                                            <li>
                                                <a href="messanger.html">
                                                    <i class="iw-16 ih-16" data-feather="maximize"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="iw-16 ih-16" data-feather="edit"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="iw-16 ih-16" data-feather="more-horizontal"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="mobile-close">
                                        <h5>close</h5>
                                    </div>
                                </div>
                                <div class="search-bar input-style icon-left">
                                    <i class="iw-16 ih-16 icon" data-feather="search"></i>
                                    <input type="text" class="form-control" placeholder="search messages...">
                                </div>
                                <div class="dropdown-content">
                                    <ul class="friend-list">
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="../assets/images/user-sm/1.jpg" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Paige Turner</h5>
                                                            <h6>Are you there ?</h6>
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
                                                    <img src="../assets/images/user-sm/2.jpg" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Paige Turner</h5>
                                                            <h6>Are you there ?</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="../assets/images/user-sm/3.jpg" alt="user">
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">Bob Frapples</h5>
                                                            <h6>hello ! how are you ?</h6>
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
                        <!-- dark/light -->
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
                                                            xlink:href="../assets/svg/icons.svg#game-controller"></use>
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
                            <a class="main-link" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-light stroke-width-3 iw-16 ih-16" data-feather="bell"></i><span
                                    class="count warning">2</span>
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
                                            <div class="media">
                                                <img src="../assets/images/user-sm/5.jpg" alt="user">
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
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="media">
                                                    <img src="../assets/images/user-sm/6.jpg" alt="user">
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
                                                    <img src="../assets/images/user-sm/7.jpg" alt="user">
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
                                                    <img src="../assets/images/user-sm/2.jpg" alt="user">
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
                                <div class="media d-none d-sm-flex ">
                                    <div class="user-img">
                                        <img src="../assets/images/user-sm/1.jpg"
                                            class="img-fluid blur-up lazyload bg-img" alt="user">
                                        <span class="available-stats online"></span>
                                    </div>
                                    <div class="media-body d-none d-md-block">
                                        <h4>Josephin water</h4>
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
                                            <a href="profile.html">
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
                                            <a href="settings.html">
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
                                            <a href="help-support.html">
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
                                            <a href="login.html">
                                                <div class="media">
                                                    <i data-feather="log-out"></i>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="mt-0">log out</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
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


    <!-- messanger section start -->
    <section class="messanger-section">
        <div class="chat-users">
            <div class="user-header">
                <a href="index.html" class="back-btn d-block d-sm-none">
                    <i class="ih-18 iw-18" data-feather="arrow-left"></i>
                </a>
                <div class="search-bar">
                    <i data-feather="search" class="icon-theme icon iw-16"></i>
                    <input type="text" class="form-control" placeholder="find friends...">
                </div>
                <a class="new-chat" href="#"><i class="icon-light iw-14 ih-14" data-feather="edit"></i></a>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user1" role="tab" aria-controls="user1"
                        aria-selected="true">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/2.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Paul Molive <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>How are you ?</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user2" role="tab" aria-controls="user2"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/3.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Anna Sthesia <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <div class="chat">
                            <h6>i have arranged the meeting at 2.30 </h6>
                            <span class="count">4</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#user3" role="tab" aria-controls="user3"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/1.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Petey Cruiser <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>i m waiting for your reply.</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user4" role="tab" aria-controls="user4"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/4.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Anna Mull <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>sure you did!</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user5" role="tab" aria-controls="user5"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/5.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Paige Turner <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>How are you ?</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user6" role="tab" aria-controls="user6"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/6.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Bob Frapples <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>How are you ?</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user7" role="tab" aria-controls="user7"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/7.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Paul Molive <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>How are you ?</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user8" role="tab" aria-controls="user8"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/8.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Paul Molive <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>How are you ?</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user9" role="tab" aria-controls="user9"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/9.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Paul Molive <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>How are you ?</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user10" role="tab" aria-controls="user10"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/10.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Paul Molive <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>How are you ?</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user11" role="tab" aria-controls="user11"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/11.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Paul Molive <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>How are you ?</h6>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#user12" role="tab" aria-controls="user12"
                        aria-selected="false">
                        <div class="media list-media">
                            <div class="story-img">
                                <div class="user-img">
                                    <img src="../assets/images/user/12.jpg" class="img-fluid blur-up lazyload bg-img"
                                        alt="user">
                                </div>
                            </div>
                            <div class="media-body">
                                <h5>Paul Molive <span>2.40 PM</span></h5>
                                <h6>online</h6>
                            </div>
                        </div>
                        <h6>How are you ?</h6>
                    </a>
                </li>
            </ul>
        </div>
        <div class="chat-content">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="user1" role="tabpanel" aria-labelledby="user1">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/2.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Paul Molive </h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/2.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="user-name">
                                <h5>Paul Molive </h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user2" role="tabpanel" aria-labelledby="user2">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/3.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Anna Sthesia </h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/3.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="user-name">
                                <h5>Anna Sthesia</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="user3" role="tabpanel" aria-labelledby="user3">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/1.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Petey Cruiser</h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/1.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="user-name">
                                <h5>Petey Cruiser</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user4" role="tabpanel" aria-labelledby="user4">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/4.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Anna Mull </h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/4.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="user-name">
                                <h5>Anna Mull</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user5" role="tabpanel" aria-labelledby="user5">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/5.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Bob Frapples</h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/5.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="user-name">
                                <h5>Bob Frapples </h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user6" role="tabpanel" aria-labelledby="user6">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/6.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Petey Cruiser</h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/6.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="user-name">
                                <h5>Petey Cruiser</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user7" role="tabpanel" aria-labelledby="user7">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/7.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Petey Cruiser</h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/7.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="user-name">
                                <h5>Petey Cruiser</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user8" role="tabpanel" aria-labelledby="user8">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/8.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Petey Cruiser</h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/8.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="user-name">
                                <h5>Petey Cruiser</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user9" role="tabpanel" aria-labelledby="user9">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/9.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Petey Cruiser</h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/9.jpg" class="img-fluid blur-up lazyload bg-img" alt="">
                            </div>
                            <div class="user-name">
                                <h5>Petey Cruiser</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user10" role="tabpanel" aria-labelledby="user10">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/10.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Petey Cruiser</h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/10.jpg" class="img-fluid blur-up lazyload bg-img"
                                    alt="">
                            </div>
                            <div class="user-name">
                                <h5>Petey Cruiser</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user11" role="tabpanel" aria-labelledby="user11">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/11.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Petey Cruiser</h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/11.jpg" class="img-fluid blur-up lazyload bg-img"
                                    alt="">
                            </div>
                            <div class="user-name">
                                <h5>Petey Cruiser</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="user12" role="tabpanel" aria-labelledby="user12">
                    <div class="tab-box">
                        <div class="user-chat">
                            <div class="user-title">
                                <div class="back-btn d-block d-sm-none">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="media list-media">
                                    <div class="story-img">
                                        <div class="user-img">
                                            <img src="../assets/images/user/12.jpg"
                                                class="img-fluid blur-up lazyload bg-img" alt="user">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h5>Petey Cruiser</h5>
                                        <h6>active 10m ago</h6>
                                    </div>
                                </div>
                                <div class="menu-option">
                                    <ul>
                                        <li>
                                            <a href="#"><i data-feather="phone" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="video" class="icon-dark"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i data-feather="settings" class="icon-dark"></i></a>
                                        </li>
                                        <li class="d-block d-lg-none info-user">
                                            <a href="#"><i data-feather="info" class="icon-dark"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-history">
                                <div class="avenue-messenger">
                                    <div class="chat">
                                        <div class="messages-content">
                                            <div class="message new">
                                                Well, I thought the main character’s situation was interesting, but his
                                                attitude toward women bothered me.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I can see that. It definitely seemed like he had some problems with
                                                women.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                I would have liked to understand how that started. I mean, the book
                                                didn’t go into too much detail about why he felt that way.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                I agree with that. I think the author could have handled that part
                                                better. I did enjoy the descriptions, though.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message new">
                                                Oh yes, the writing was beautiful! That just made me more disappointed
                                                in the character.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                            <div class="message message-personal new">
                                                Well, this is just my opinion, but maybe the character would have been
                                                easier to understand if the writing had been simpler. It seemed like the
                                                author spent a lot of time on the descriptions, when he could have spent
                                                more time on the character’s thoughts.
                                                <div class="timestamp">15:13</div>
                                                <div class="checkmark-sent-delivered">✓</div>
                                                <div class="checkmark-read">✓</div>
                                            </div>
                                        </div>
                                        <div class="message-box">
                                            <textarea class="message-input emojiPicker"
                                                placeholder="Type message..."></textarea>
                                            <div class="add-extent">
                                                <i class="fas fa-plus animated-btn"></i>
                                                <div class="options">
                                                    <ul>
                                                        <li><img src="../assets/svg/image.svg" alt=""></li>
                                                        <li><img src="../assets/svg/paperclip.svg" alt=""></li>
                                                        <li><img src="../assets/svg/camera.svg" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <a href="#" class="message-submit"><i data-feather="send"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="user-info">
                            <div class="back-btn d-lg-none d-block">
                                <i data-feather="x" class="icon-theme"></i>
                            </div>
                            <div class="user-image">
                                <img src="../assets/images/user/12.jpg" class="img-fluid blur-up lazyload bg-img"
                                    alt="">
                            </div>
                            <div class="user-name">
                                <h5>Petey Cruiser</h5>
                                <h6>london, united kingdom</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora possimus magnam
                                    adipisci aspernatur.</p>
                                <div class="social-btn">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#facebook"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#twitter"></use>
                                                </svg>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a href="#">
                                                <svg>
                                                    <use xlink:href="../assets/svg/icons.svg#whatsapp"></use>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="user-gallery">
                                <h5>media <a href="#">see all</a></h5>
                                <div class="gallery-section">
                                    <div class="portfolio-section ratio_square">
                                        <div class="container-fluid p-0">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/2.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/4.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="overlay">
                                                        <div class="portfolio-image">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#imageModel">
                                                                <img src="../assets/images/post/11.jpg" alt=""
                                                                    class="img-fluid blur-up lazyload bg-img">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- messanger section end -->


    <!-- theme setting -->
    <div class="theme-settings">
        <div class="rtl-btn">
            <div class="theme-layout-version">RTL</div>
        </div>
        <div class="rtl-btn h-cls">
            <div class="dark-button">Dark</div>
        </div>
        <div class="pages">
            <a href="javascript:void(0)" onclick="openSetting()">
                <div class="theme-setting-sidebar" id="setting-icon">
                    <div>
                        pages
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div id="setting_box" class="setting-box">
        <a href="javascript:void(0)" class="overlay" onclick="closeSetting()"></a>
        <div class="setting_box_body">
            <div onclick="closeSetting()">
                <div class="sidebar-back text-left"><i class="fa fa-angle-left pe-2" aria-hidden="true"></i> Back</div>
            </div>
            <div class="setting-body">
                <div class="setting-title">
                    <h4>Newsfeed Layout</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/1.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 1</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/2.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 2</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-2.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/3.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 3</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-3.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/4.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 4</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-4.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/5.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 5</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-5.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/6.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 6</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-6.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/7.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 7</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-7.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/8.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 8</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-8.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/9.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 9</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-9.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/10.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 10</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-10.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/11.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 11</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-11.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/newsfeed/12.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>style 12</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('index-12.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>Profile Pages</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/profile/1.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>timeline</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('profile.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/profile/2.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>about</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('profile-about.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/profile/3.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>friends</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('profile-friends.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/profile/4.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>gallery</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('profile-gallery.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/profile/5.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>acitivity feed</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('profile-activityfeed.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/profile/6.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>tab</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('profile-tab.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/profile/7.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>friend profile</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('profile(friend).html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>Favourite Page</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/favourite/1.jpg" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>page listing </h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('page-list.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/favourite/2.jpg" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>page home</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('single-page.html')"
                                            class="btn new-tab-btn">Preview</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/favourite/3.jpg" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>about</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('single-about.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/favourite/4.jpg" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>review</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('single-reviews.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/favourite/5.jpg" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>gallery</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('single-gallery.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/favourite/6.jpg" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>tab</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('page-tab.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>other pages</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/events.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>event & calendar</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('event.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/birthday.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Birthday</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('birthday.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/weather.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>weather</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('weather.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/music.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Music</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('music.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/events.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>games</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('games.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/login.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>login </h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('login.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/register.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>register</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('register.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/help.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>help & support</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('help-support.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/messanger.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>messanger</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('messanger.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/setting.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>setting</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('settings.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/other/help.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>help article</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('help-article.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>Company Pages</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/company/home.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Home</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('company-home.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/company/about.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>About</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('about-us.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/company/blog.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Blog</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('blog.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/company/blog-details.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Blog details</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('blog-details.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/company/faq.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>FAQ</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('faq.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/company/career.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Career</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('career.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/company/career-details.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>Career details</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('career-details.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/company/coming-soon.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>coming soon</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('coming-soon.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/company/404.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>404</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('404.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting-title">
                    <h4>Element Pages</h4>
                </div>
                <div class="setting-contant">
                    <div class="row demo-section">
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/element/typography.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>typography</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('typography.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/element/widget.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>sidebar widgets</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('sidebar-widgets.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/element/calendar.jpg"
                                        class="bg-img blur-up lazyload" alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>calender</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('element-event-calendar.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/element/map.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>maps</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('element-map.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/element/icons.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>icons</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('icons.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/element/modal.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>modal</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('element-modal.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 text-center demo-effects">
                            <div class="set-position">
                                <div class="layout-container">
                                    <img src="../assets/images/demo/element/buttons.jpg" class="bg-img blur-up lazyload"
                                        alt="">
                                </div>
                                <div class="demo-text">
                                    <h4>buttons</h4>
                                    <div class="btn-group demo-btn" role="group" aria-label="Basic example"> <button
                                            type="button" onClick="window.open('element-button.html')"
                                            class="btn new-tab-btn">Preview</button> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buy_btn">
                    <a href="#" target="_blank" class="btn btn-block btn-solid ">purchase Friendbook now!</a>
                </div>
            </div>
        </div>
    </div>
    <!-- theme setting -->


    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <!-- popper js-->
    <script src="../assets/js/popper.min.js"></script>

    <!-- feather icon js-->
    <script src="../assets/js/feather.min.js"></script>

    <!-- emoji picker js-->
    <script src="../assets/js/emojionearea.min.js"></script>

    <!-- messanger js -->
    <script src="../assets/js/jquery-migrate-1.4.1.min.js"></script>
    <script
        src="../assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../assets/js/messanger.js"></script>

    <!-- Bootstrap js-->
    <script src="../assets/js/bootstrap.js"></script>

    <!-- lazyload js-->
    <script src="../assets/js/lazysizes.min.js"></script>

    <!-- theme setting js-->
    <script src="../assets/js/theme-setting.js"></script>

    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>

    <script>
        feather.replace();
        $(".emojiPicker").emojioneArea({
            inline: true,
            placement: 'absright',
            pickerPosition: "top",
        });
    </script>

</body>

</html>