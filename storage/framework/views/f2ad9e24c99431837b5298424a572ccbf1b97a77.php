<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?></title>

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
    <link rel="icon" type="image/png" href="<?php echo e(asset('storage/images/FAVICON.png')); ?>">
<style>
.dropdown {
  position: relative;
  display: inline-block;
}
.dropdown:hover .dropdown-content {display: block;}
.dropbtn {
  background-color: transparent;
  color: <?php echo e(getSetting('THEME_COLOR')); ?>;
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
    <?php echo $__env->yieldContent('style'); ?>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <img src="<?php echo e(asset('storage/images/LOGO.png')); ?>"
                    alt="<?php echo e(getSetting('APPLICATION_NAME')); ?>">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="<?php echo e(__('Toggle navigation')); ?>">
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
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if(Route::has('login') && getSetting('AUTH_MODE') == 'enabled'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(Route::has('register') && getSetting('AUTH_MODE') == 'enabled'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>"><button
                                        class="btn btn-theme"><?php echo e(__('Join Now')); ?></button></a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if(getSetting('AUTH_MODE') == 'enabled' && getSetting('PAYMENT_MODE') == 'enabled' && Auth::user()->gender == 'man'): ?>
                            <li>
                                <div class="dropdown">
                                  <button class="dropbtn">Buy</button>
                                  <div class="dropdown-content">
                                    <h3 class="text-center" style="color:white"><?php echo e(round((Auth::user()->points)/60)); ?></h3>  
                                    <h5 class="text-center" style="color:white">Minutes left</h5>
                                    <div class="d-flex justify-content-center">
                                        <a class="btn btn-primary" href="<?php echo e(route('pricing')); ?>">Buy</a>
                                    </div>
                                  </div>
                                </div>
                            </li>
                        <?php endif; ?>
                        <?php if(Auth::user()->role == 'admin'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('admin')); ?>"><?php echo e(__('Admin')); ?></a>
                            </li>
                        <?php endif; ?>

                        

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img class="auth-avatar" src="<?php echo e(asset('storage/images/user_photos/' . $avatar['avatar_name'])); ?>" width=45 height=45>
                                <span class="available-stats online"></span>
                                <img id="selfCountryflag" src="" alt="Country Flag" width="25" class="mr-2" hidden />
                                <?php echo e(Auth::user()->username); ?>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo e(route('profile')); ?>">
                                    Profile
                                </a>
                                <?php if(getSetting('PAYMENT_MODE') == 'enabled'): ?>
                                    <?php if(Auth::user()->gender == 'man'): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('man_transaction')); ?>">
                                        Transaction
                                    </a>
                                    <?php else: ?>
                                    <a class="dropdown-item" href="<?php echo e(route('women_withdraw')); ?>">
                                        Withdraw
                                    </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <a class="dropdown-item" href="<?php echo e(route('changePassword')); ?>">
                                    Change Password
                                </a>
                                <a class="dropdown-item" onclick="logoutControl('<?php echo e(Auth::user()->email); ?>'); event.preventDefault();">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

        <footer>
            <div class="container-fluid">
                <div class="row d-flex align-items-center">
                    <div class="col-8 text-left pad-res">
                        <ul class="footer-links">
                            <li>
                                <a href="<?php echo e(route('termsAndConditions')); ?>" target="_blank">Terms & Conditions</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('privacyPolicy')); ?>" target="_blank">Privacy Policy</a>
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
        const socialInvitation = "<?php echo e(getSetting('SOCIAL_INVITATION')); ?>";
    </script>
    <!-- Scripts -->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/app.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/toastr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
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
    <?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH /home/admin/fluky/resources/views/layouts/app.blade.php ENDPATH**/ ?>