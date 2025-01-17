<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="friendbook">
  <meta name="keywords" content="friendbook">
  <meta name="author" content="friendbook">
  <link rel="icon" type="image/png" href="<?php echo e(asset('assets/images/favicon.png')); ?>">
  <title><?php echo e(getSetting('APPLICATION_NAME')); ?></title>

  <!--Google font-->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- swiper slider-->
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/swiper.min.css')); ?>">

  <!-- Theme css -->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/landing.css')); ?>">

</head>

<body>


  <!-- home section start -->
  <section class="home-landing bg-light p-0">
    <!-- header -->
    <nav class="navbar navbar-expand-lg">
      <div class="container custom-container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
          <img src="<?php echo e(asset('assets/images/icon/logo.png')); ?>" class="img-fluid" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars navbar-toggler-icon"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
          <ul class="nav navbar-nav">
            <li class="nav-item d-lg-none d-inline-block back-btn" data-bs-toggle="collapse"
              data-bs-target="#navbarNavDropdown">
              <a class="nav-link" href="#">back</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo e(url('/')); ?>">Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="landing-section">
      <div>
        <h1>Losmagz is a great way to meet new friends, here we pick someone randomly to help you start the conversation</h1>
        <div class="buttons">
          <a href="" class="btn btn-white btn-lg mx-2">purchase now</a>
          <a href="" class="btn btn btn-outline-light btn-lg mx-2">explore now</a>
        </div>
        <div class="laptop-image">
          <img src="<?php echo e(asset('assets/images/landing/home/laptop-1.png')); ?>" class="img-fluid wow zoomIn" alt="">
        </div>
      </div>
    </div>
    <div class="home-animation d-none d-sm-block">
      <img src="<?php echo e(asset('assets/images/landing/home/group2.png')); ?>" class="img-fluid img-1 wow zoomIn" data-wow-delay="0.30s" alt="">
      <img src="<?php echo e(asset('assets/images/landing/home/heart3.png')); ?>" class="img-fluid img-2 wow zoomIn d-xl-block d-none"
        data-wow-delay="0.35s" alt="">
      <img src="<?php echo e(asset('assets/images/landing/home/like-blue.png')); ?>" class="img-fluid img-3 wow zoomIn" data-wow-delay="0.40s"
        alt="">
      <img src="<?php echo e(asset('assets/images/landing/home/group1.png')); ?>" class="img-fluid img-4 wow zoomIn" data-wow-delay="0.45s" alt="">
      <img src="<?php echo e(asset('assets/images/landing/home/like-white.png')); ?>" class="img-fluid img-5 wow zoomIn" data-wow-delay="0.80s"
        alt="">
      <img src="<?php echo e(asset('assets/images/landing/home/like-white.png')); ?>" class="img-fluid img-6 wow zoomIn" data-wow-delay="0.85s"
        alt="">
      <img src="<?php echo e(asset('assets/images/landing/home/heart3.png')); ?>" class="img-fluid img-7 wow zoomIn d-xl-block d-none"
        data-wow-delay="0.60s" alt="">
      <img src="<?php echo e(asset('assets/images/landing/home/heart1.png')); ?>" class="img-fluid img-8 wow zoomIn" data-wow-delay="0.65s" alt="">
      <img src="<?php echo e(asset('assets/images/landing/home/heart1.png')); ?>" class="img-fluid img-9 wow zoomIn" data-wow-delay="0.70s" alt="">
    </div>
  </section>
  <!-- home section end -->


  <!--feture-section start -->
  <section class="features bg-light">
    <div class="animation animation-feature">
      <div class="cross"></div>
      <div class="tringle-1"></div>
      <div class="tringle-2"></div>
      <div class="circle-1"></div>
      <div class="circle-2"></div>
    </div>
    <div class="container custom-container">
      <div class="row">
        <div class="col-12 title">
          <h5>Our smart features</h5>
          <div class="title-effect">
            <h2>we provide best features</h2>
            <img src="<?php echo e(asset('assets/images/landing/icon/title-effect.png')); ?>" alt="title-effect" class="img-fluid">
          </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn">
          <div class="feature-content">
            <div class="icon-effect-area">
              <img src="<?php echo e(asset('assets/images/landing/icon/icon.png')); ?>" alt="icons" class="icon img-fluid">
              <img src="<?php echo e(asset('assets/images/landing/icon/icon-effect.png')); ?>" alt="icon-effect" class="icon-effect">
            </div>
            <h3>Clean code</h3>
            <p>Clean code with Sass 7-1 Pattern and properly commented.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn">
          <div class="feature-content">
            <div class="icon-effect-area">
              <img src="<?php echo e(asset('assets/images/landing/icon/responsive.png')); ?>" alt="icons" class="icon img-fluid">
              <img src="<?php echo e(asset('assets/images/landing/icon/icon-effect.png')); ?>" alt="icon-effect" class="icon-effect resp-design">
            </div>
            <h3>Responsive</h3>
            <p>fully app style responsive design for user & easy to operate in device.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn">
          <div class="feature-content">
            <div class="icon-effect-area">
              <img src="<?php echo e(asset('assets/images/landing/icon/1.png')); ?>" alt="icons" class="icon img-fluid">
              <img src="<?php echo e(asset('assets/images/landing/icon/icon-effect.png')); ?>" alt="icon-effect" class="icon-effect easy-int">
            </div>
            <h3>Easy RTL</h3>
            <p>Design your website LTR or RTL, Friendbook supports multi-languages.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn">
          <div class="feature-content">
            <div class="icon-effect-area">
              <img src="<?php echo e(asset('assets/images/landing/icon/dark.png')); ?>" alt="icons" class="icon img-fluid">
              <img src="<?php echo e(asset('assets/images/landing/icon/icon-effect.png')); ?>" alt="icon-effect" class="icon-effect dn-mode">
            </div>
            <h3>day night mode</h3>
            <p>we provide one more smart feature supports day & night mode.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn">
          <div class="feature-content">
            <div class="icon-effect-area">
              <img src="<?php echo e(asset('assets/images/landing/icon/service.png')); ?>" alt="icons" class="icon img-fluid">
              <img src="<?php echo e(asset('assets/images/landing/icon/icon-effect.png')); ?>" alt="icon-effect" class="icon-effect support">
            </div>
            <h3>24*7 supports</h3>
            <p>Our support team are always there to support you and guide you.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 wow zoomIn">
          <div class="feature-content">
            <div class="icon-effect-area">
              <img src="<?php echo e(asset('assets/images/landing/icon/well.png')); ?>" alt="icons" class="icon img-fluid">
              <img src="<?php echo e(asset('assets/images/landing/icon/icon-effect.png')); ?>" alt="icon-effect" class="icon-effect manage">
            </div>
            <h3>well managed</h3>
            <p>We design proper documentation which is easy and simple to understand.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- feature section end -->


  <!-- Newsfeed section start -->
  <section class="newsfeed-section">
    <div class="animation animation-newsfeed">
      <div class="cross"></div>
      <div class="tringle-1"></div>
      <div class="tringle-2"></div>
      <div class="circle-1"></div>
      <div class="circle-2"></div>
    </div>
    <div class="container custom-container">
      <div class="row">
        <div class="col-12 title">
          <h5>Newsfeed variations</h5>
          <div class="title-effect">
            <h2>we have different newsfeeds</h2>
            <img src="<?php echo e(asset('assets/images/landing/icon/title-effect.png')); ?>" alt="title-effect" class="ing-fluid">
          </div>
        </div>
        <div class="col-12">
          <ul class="newsfeed-img">
            <li>
              <a href="#" title=""><img src="<?php echo e(asset('assets/images/landing/newsfeed/1.jpg')); ?>" alt="" class="img-fluid"></a>
            </li>
            <li class="d-md-block d-none">
              <a href="#" title=""><img src="<?php echo e(asset('assets/images/landing/newsfeed/2.jpg')); ?>" alt="" class="img-fluid"></a>
            </li>
            <li class="d-xl-block d-none">
              <a href="#" title=""><img src="<?php echo e(asset('assets/images/landing/newsfeed/3.jpg')); ?>" alt="" class="img-fluid"></a>
            </li>
            <li>
              <a href="#" title=""><img src="<?php echo e(asset('assets/images/landing/newsfeed/4.jpg')); ?>" alt="" class="img-fluid"></a>
            </li>
            <li>
              <a href="#" title=""><img src="<?php echo e(asset('assets/images/landing/newsfeed/5.png')); ?>" alt="" class="img-fluid"></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 p-0">
          <div class="slider-area slider no-arrow">
            <a href="html/index.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img1.jpg')); ?>">
              <div class="overlay">
                <h3>style 1</h3>
              </div>
            </a>
            <a href="html/index-2.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img2.jpg')); ?>">
              <div class="overlay">
                <h3>style 2</h3>
              </div>
            </a>
            <a href="html/index-3.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img3.jpg')); ?>">
              <div class="overlay">
                <h3>style 3</h3>
              </div>
            </a>
            <a href="html/index-4.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img4.jpg')); ?>">
              <div class="overlay">
                <h3>style 4</h3>
              </div>
            </a>
            <a href="html/index-5.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img5.jpg')); ?>">
              <div class="overlay">
                <h3>style 5</h3>
              </div>
            </a>
            <a href="html/index-6.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img6.jpg')); ?>">
              <div class="overlay">
                <h3>style 6</h3>
              </div>
            </a>
            <a href="html/index-7.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img7.jpg')); ?>">
              <div class="overlay">
                <h3>style 7</h3>
              </div>
            </a>
            <a href="html/index-8.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img8.jpg')); ?>">
              <div class="overlay">
                <h3>style 8</h3>
              </div>
            </a>
            <a href="html/index-9.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img9.jpg')); ?>">
              <div class="overlay">
                <h3>style 9</h3>
              </div>
            </a>
            <a href="html/index-10.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img10.jpg')); ?>">
              <div class="overlay">
                <h3>style 10</h3>
              </div>
            </a>
            <a href="html/index-11.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img11.jpg')); ?>">
              <div class="overlay">
                <h3>style 11</h3>
              </div>
            </a>
            <a href="html/index-12.html" target="_blank" class="img-section">
              <img src="<?php echo e(asset('assets/images/landing/newsfeed/img12.jpg')); ?>">
              <div class="overlay">
                <h3>style 12</h3>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Newsfeed section end -->


  <!--pages list start -->
  <section class="friendbook-page bg-light">
    <div class="animation animation-frndbookpage">
      <div class="cross"></div>
      <div class="tringle-1"></div>
      <div class="tringle-2"></div>
      <div class="circle-1"></div>
      <div class="circle-2"></div>
    </div>
    <div class="container custom-container">
      <div class="row title">
        <div class="col-12">
          <h5>friendbook page</h5>
          <div class="title-effect">
            <h2>20+ designed pages</h2>
            <img src="<?php echo e(asset('assets/images/landing/icon/title-effect.png')); ?>" alt="title-effect" class="img-fluid">
          </div>
        </div>
      </div>
      <div class="row text-center pages-row">
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/profile.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/profile.jpg')); ?>" alt="" class="img-fluid">
              <h3>Profile timeline</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/profile-about.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/about.jpg')); ?>" alt="" class="img-fluid">
              <h3>Profile about</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/profile-friends.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/friends.jpg')); ?>" alt="" class="img-fluid">
              <h3>Profile friend</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/profile-gallery.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/gallery.jpg')); ?>" alt="" class="img-fluid">
              <h3>Profile gallery</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/profile-activityfeed.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/activity.jpg')); ?>" alt="" class="img-fluid">
              <h3>Profile activity feed</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/profile-tab.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/tab.jpg')); ?>" alt="" class="img-fluid">
              <h3>all in one tab</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/profile(friend).html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/friend.jpg')); ?>" alt="" class="img-fluid">
              <h3>friend's profile</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/page-list.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/listing.jpg')); ?>" alt="" class="img-fluid">
              <h3>page listing</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/single-page.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/company.jpg')); ?>" alt="" class="img-fluid">
              <h3>favourite page</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/single-about.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/cm-about.jpg')); ?>" alt="" class="img-fluid">
              <h3>page about</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/single-gallery.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/cm-gallery.jpg')); ?>" alt="" class="img-fluid">
              <h3>page gallery</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/single-reviews.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/review.jpg')); ?>" alt="" class="img-fluid">
              <h3>page review</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/page-tab.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/cm-tab.jpg')); ?>" alt="" class="img-fluid">
              <h3>page tab</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/event.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/events.jpg')); ?>" alt="" class="img-fluid">
              <h3>events & calendar</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/birthday.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/birthday.jpg')); ?>" alt="" class="img-fluid">
              <h3>birthday</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/weather.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/weather.jpg')); ?>" alt="" class="img-fluid">
              <h3>weather</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/music.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/music.jpg')); ?>" alt="" class="img-fluid">
              <h3>music</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/games.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/games.jpg')); ?>" alt="" class="img-fluid">
              <h3>games</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/login.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/login.jpg')); ?>" alt="" class="img-fluid">
              <h3>login/register</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/help-support.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/help.jpg')); ?>" alt="" class="img-fluid">
              <h3>help and support</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/messanger.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/messanger.jpg')); ?>" alt="" class="img-fluid">
              <h3>messanger</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/settings.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/setting.jpg')); ?>" alt="" class="img-fluid">
              <h3>settings</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/help-article.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/help-article.jpg')); ?>" alt="" class="img-fluid">
              <h3>help article</h3>
            </a>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 wow zoomIn">
          <div class="friendbook-content">
            <a href="html/contact-us.html" title="">
              <img src="<?php echo e(asset('assets/images/landing/demo/contact.jpg')); ?>" alt="" class="img-fluid">
              <h3>contact us</h3>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--pages list end -->


  <!-- company pages start -->
  <section class="friendbook-company">
    <div class="container-fluid">
      <div class="animation animation-friendbook-company">
        <div class="cross"></div>
        <div class="tringle-1"></div>
        <div class="tringle-2"></div>
        <div class="circle-2"></div>
      </div>
    </div>
    <div class="container custom-container">
      <div class="row title">
        <div class="col-12">
          <h5>Company pages</h5>
          <div class="title-effect">
            <h2>friendbook company pages</h2>
            <img src="<?php echo e(asset('assets/images/landing/icon/title-effect.png')); ?>" alt="title-effect" class="img-fluid">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="row">
            <div class="col-sm-6">
              <a href="html/about-us.html">
                <div class="friendbook-company-content">
                  <img src="<?php echo e(asset('assets/images/landing/company/about.jpg')); ?>" alt="" class="img-fluid">
                  <div class="overlay-frindbook">
                    <blockquote class="blockquote">
                      <h4 class="mb-0">friendbook</h4>
                      <p>About</p>
                    </blockquote>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6">
              <a href="html/blog.html">
                <div class="friendbook-company-content">
                  <img src="<?php echo e(asset('assets/images/landing/company/blog.jpg')); ?>" alt="" class="img-fluid">
                  <div class="overlay-frindbook">
                    <blockquote class="blockquote">
                      <h4 class="mb-0">friendbook</h4>
                      <p>Blog</p>
                    </blockquote>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6">
              <a href="html/blog-detail.html" title="">
                <div class="friendbook-company-content">
                  <img src="<?php echo e(asset('assets/images/landing/company/blog-details.jpg')); ?>" alt="" class="img-fluid">
                  <div class="overlay-frindbook">
                    <blockquote class="blockquote">
                      <h4 class="mb-0">friendbook</h4>
                      <p>Blog details</p>
                    </blockquote>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6 left-bottom-img-frindbook">
              <a href="html/faq.html" title="">
                <div class="friendbook-company-content">
                  <img src="<?php echo e(asset('assets/images/landing/company/faq.jpg')); ?>" alt="" class="img-fluid">
                  <div class="overlay-frindbook">
                    <blockquote class="blockquote">
                      <h4 class="mb-0">friendbook</h4>
                      <p>FAQ</p>
                    </blockquote>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-12">
          <a href="html/company-home.html" title="">
            <div class="friendbook-company-content">
              <img src="<?php echo e(asset('assets/images/landing/company/home.jpg')); ?>" alt="" class="img-fluid">
              <div class="overlay-frindbook">
                <blockquote class="blockquote">
                  <h4 class="mb-0">friendbook</h4>
                  <p>Home</p>
                </blockquote>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="html/coming-soon.html" title="">
            <div class="friendbook-company-content">
              <img src="<?php echo e(asset('assets/images/landing/company/coming-soon.jpg')); ?>" alt="" class="img-fluid">
              <div class="overlay-frindbook">
                <blockquote class="blockquote">
                  <h4 class="mb-0">friendbook</h4>
                  <p>coming soon</p>
                </blockquote>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="html/career.html" title="">
            <div class="friendbook-company-content">
              <img src="<?php echo e(asset('assets/images/landing/company/career.jpg')); ?>" alt="" class="img-fluid">
              <div class="overlay-frindbook">
                <blockquote class="blockquote">
                  <h4 class="mb-0">friendbook</h4>
                  <p>career</p>
                </blockquote>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="html/career-details.html" title="">
            <div class="friendbook-company-content">
              <img src="<?php echo e(asset('assets/images/landing/company/career-details.jpg')); ?>" alt="" class="img-fluid">
              <div class="overlay-frindbook">
                <blockquote class="blockquote">
                  <h4 class="mb-0">friendbook</h4>
                  <p>career details</p>
                </blockquote>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="html/404.html" title="">
            <div class="friendbook-company-content">
              <img src="<?php echo e(asset('assets/images/landing/company/404.jpg')); ?>" alt="" class="img-fluid">
              <div class="overlay-frindbook">
                <blockquote class="blockquote">
                  <h4 class="mb-0">friendbook</h4>
                  <p>404</p>
                </blockquote>
              </div>
            </div>
          </a>
        </div>
      </div>
  </section>
  <!-- company pages end -->


  <!-- element pages start -->
  <section class="element-section bg-light">
    <div class="animation animation-friendbook-company">
      <div class="cross"></div>
      <div class="tringle-1"></div>
      <div class="tringle-2"></div>
      <div class="circle-2"></div>
    </div>
    <div class="container-fluid p-0">
      <div class="row title">
        <div class="col-12">
          <h5>element pages</h5>
          <div class="title-effect">
            <h2>friendbook element pages</h2>
            <img src="<?php echo e(asset('assets/images/landing/icon/title-effect.png')); ?>" alt="title-effect" class="img-fluid">
          </div>
        </div>
      </div>
      <div class="row element-section-space">
        <div class="col-xl-6 col-md-5 col-12 d-md-block d-none">
          <div class="laptop-element">
            <img src="<?php echo e(asset('assets/images/landing/element/laptop.png')); ?>" class="img-fluid" alt="">
            <div class="element-image">
              <img src="<?php echo e(asset('assets/images/landing/element/birthday.png')); ?>" class="img-fluid img-1 wow zoomIn" alt="">
              <img src="<?php echo e(asset('assets/images/landing/element/group-9.png')); ?>" class="img-fluid img-2 d-none d-xl-block wow zoomIn" alt="">
              <img src="<?php echo e(asset('assets/images/landing/element/group-10.png')); ?>" class="img-fluid img-3 wow zoomIn" alt="">
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-7 col-12">
          <div class="slider-element">
            <div class="swiper-container overflow-hidden">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <div class="slider-content">
                    <a target="_blank" href="html/sidebar-widgets.html">
                      <img src="<?php echo e(asset('assets/images/landing/element/widgets.jpg')); ?>" class="img-fluid" alt="">
                      <h3>widgets</h3>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="slider-content">
                    <a target="_blank" href="html/element-event-calendar.html">
                      <img src="<?php echo e(asset('assets/images/landing/element/calendar.jpg')); ?>" class="img-fluid" alt="">
                      <h3>event calendar</h3>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="slider-content">
                    <a target="_blank" href="html/typography.html">
                      <img src="<?php echo e(asset('assets/images/landing/element/typography.jpg')); ?>" class="img-fluid" alt="">
                      <h3>typography</h3>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="slider-content">
                    <a target="_blank" href="html/element-map.html">
                      <img src="<?php echo e(asset('assets/images/landing/element/map.jpg')); ?>" class="img-fluid" alt="">
                      <h3>google map</h3>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="slider-content">
                    <a target="_blank" href="html/icons.html">
                      <img src="<?php echo e(asset('assets/images/landing/element/icons.jpg')); ?>" class="img-fluid" alt="">
                      <h3>icons</h3>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="slider-content">
                    <a target="_blank" href="html/element-modal.html">
                      <img src="<?php echo e(asset('assets/images/landing/element/modal.jpg')); ?>" class="img-fluid" alt="">
                      <h3>modal</h3>
                    </a>
                  </div>
                </div>
                <div class="swiper-slide">
                  <div class="slider-content">
                    <a target="_blank" href="html/element-button.html">
                      <img src="<?php echo e(asset('assets/images/landing/element/buttons.jpg')); ?>" class="img-fluid" alt="">
                      <h3>buttons</h3>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>
  <!-- element pages end -->



  <!--core feature section  -->
  <section class="core-feature">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="animation animation-core">
            <div class="cross"></div>
            <div class="tringle-1"></div>
            <div class="tringle-2"></div>
            <div class="circle-1"></div>
            <div class="circle-2"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container custom-container">
      <div class="row title">
        <div class="col-12">
          <h5>core features</h5>
          <div class="title-effect">
            <h2>friendbook core features</h2>
            <img src="<?php echo e(asset('assets/images/landing/icon/title-effect.png')); ?>" alt="title-effect" class="img-fluid">
          </div>
        </div>
      </div>
      <div class="row text-center feature-row">
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/pages.png')); ?>" alt="core-features" class="img-fluid">
              <h5>50+ pages</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/html5.png')); ?>" alt="" class="img-fluid">
              <h5>html5</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/css.png')); ?>" alt="" class="img-fluid">
              <h5>css3</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/sass.png')); ?>" alt="" class="img-fluid">
              <h5>sass</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/bootstrap.png')); ?>" alt="" class="img-fluid">
              <h5>bootstrap</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/gulp.png')); ?>" alt="" class="img-fluid">
              <h5>gulp</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/w3c.png')); ?>" alt="" class="img-fluid">
              <h5>w3c validate</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/font.png')); ?>" alt="" class="img-fluid">
              <h5>google font</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/paper.png')); ?>" alt="" class="img-fluid">
              <h5>well documentation</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/seo.png')); ?>" alt="" class="img-fluid">
              <h5>seo friendly</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/calendar.png')); ?>" alt="" class="img-fluid">
              <h5>full calendar</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/color-wheel.png')); ?>" alt="" class="img-fluid">
              <h5>unlimited color</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/heart.png')); ?>" alt="" class="img-fluid">
              <h5>chat</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/support.png')); ?>" alt="" class="img-fluid">
              <h5>customer support</h5>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 wow fadeInUp">
          <div class="core-content">
            <div>
              <img src="<?php echo e(asset('assets/images/landing/core/monitor.png')); ?>" alt="" class="img-fluid">
              <h5>responsive</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="animation animation-footer">
            <div class="cross">
              <div class="cross-1"></div>
            </div>
            <div class="cross1">
              <div class="cross-2"></div>
            </div>
            <div class="tringle-1"></div>
            <div class="tringle-2"></div>
            <div class="circle-1"></div>
            <div class="circle-2"></div>
            <div class="circle-3"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="container text-center">
      <div class="row">
        <div class="col-12 text-center">
          <div class="footer-content">
            <img src="<?php echo e(asset('assets/images/landing/footer/vector-smart-object.png')); ?>" alt="footer-img" class="img-fluid">
            <h3>Have any problem?</h3>
            <p>No worries support service is always there to guide you</p>
            <ul>
              <li><a href=""><i class="fa fa-star" aria-hidden="true"></i></a></li>
              <li><a href=""><i class="fa fa-star" aria-hidden="true"></i></a></li>
              <li><a href=""><i class="fa fa-star" aria-hidden="true"></i></a></li>
              <li><a href=""><i class="fa fa-star" aria-hidden="true"></i></a></li>
              <li><a href=""><i class="fa fa-star" aria-hidden="true"></i></a></li>
            </ul>
            <button type="submit" class="btn btn-white btn-lg d-block m-auto">purchase now</button>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- latest jquery-->
  <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>

  <!-- popper js-->
  <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>

  <!-- slider js -->
  <script src="<?php echo e(asset('assets/js/slick.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/swiper.min.js')); ?>"></script>

  <!-- wow js-->
  <script src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>

  <!-- popover js for custom popover -->
  <script src="<?php echo e(asset('assets/js/popover.js')); ?>"></script>

  <!-- Bootstrap js-->
  <script src="<?php echo e(asset('assets/js/bootstrap.js')); ?>"></script>

  <!-- Theme js-->
  <script src="<?php echo e(asset('assets/js/landing-script.js')); ?>"></script>

  <script>
    new WOW().init();
  </script>

</body>

</html><?php /**PATH /home/admin/fluky/resources/views/welcome.blade.php ENDPATH**/ ?>