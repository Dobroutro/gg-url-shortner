<html lang="en">
<head>
    <title>URL Shortener API Admin</title>
    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo e(asset('/css/app.css')); ?>" rel="stylesheet">       
    <link href="<?php echo e(asset('/css/common.css')); ?>" rel="stylesheet">       
    <style type="text/css">
 
    </style>     
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <!-- Angular JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>
    <!-- MY App -->
    <script src="<?php echo e(asset('/app/packages/dirPagination.js')); ?>"></script>
    <script src="<?php echo e(asset('/app/routes.js')); ?>"></script>
    <script src="<?php echo e(asset('/app/services/itemServices.js')); ?>"></script>
    <script src="<?php echo e(asset('/app/helpers/itemsTableHelper.js')); ?>"></script>
    <!-- App Controller -->
    <script src="<?php echo e(asset('/app/controllers/ItemController.js')); ?>"></script>
    <script type="text/javascript">
        var api_token = "<?php echo Auth::user()->api_token;; ?>";
        var server_url = "<?php echo Config::get('app.url'); ?>";
    </script>
</head>
<body ng-app="main-App">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                    URL Shortener Home
                </a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li></li>
                                            
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <?php if(Auth::guest()): ?>
                        <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                        <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" 
                                onclick="event.preventDefault();"
                                role="button" aria-expanded="false">
                                <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="<?php echo e(url('/logout')); ?>"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">



            </div>          
        </div>
    </nav>
    <div class="container">
        <ng-view></ng-view>
    </div>
</body>
</html>