<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="description" content="<?php echo $description; ?>">
        <meta content="" name="author" />
        <!-- Extra metadata -->
        <?php echo $metadata; ?>
        <!-- / -->

        <!-- favicon.ico and apple-touch-icon.png -->

        <!-- start: GOOGLE FONTS -->
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
        <!-- end: GOOGLE FONTS -->

        <!-- start: MAIN CSS -->
        <link href="<?php echo assets_url('vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" >
        <link rel="stylesheet" href="<?php echo assets_url('vendor/fontawesome/css/font-awesome.min.css')?>">
        <link rel="stylesheet" href="<?php echo assets_url('vendor/themify-icons/themify-icons.min.css')?>">
        <link href="<?php echo assets_url('vendor/animate.css/animate.min.css')?>" rel="stylesheet" media="screen">
        <link href="<?php echo assets_url('vendor/perfect-scrollbar/perfect-scrollbar.min.css')?>" rel="stylesheet" media="screen">
        <link href="<?php echo assets_url('vendor/switchery/switchery.min.css')?>" rel="stylesheet" media="screen">
        <!-- end: MAIN CSS -->

        <!-- start: Custom CSS -->
        <link href="<?php echo assets_url('assets/css/styles.css'); ?>" rel="stylesheet" >
        <link rel="stylesheet" href="<?php echo assets_url('assets/css/plugins.css'); ?>">
        <link rel="stylesheet" href="<?php echo assets_url('assets/css/themes/theme-4.css'); ?>" id="skin_color" />
        <!-- end: Custom CSS -->

        <!-- Custom styles -->
        <?php echo $css; ?>
        <!-- / -->
    </head>
    <body class="">
        <?php echo $body; ?>
        <!-- / -->
        
        <script src="<?php echo assets_url('vendor/jquery/jquery.min.js'); ?>"></script>
        <script src="<?php echo assets_url('vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo assets_url('vendor/modernizr/modernizr.js'); ?>"></script>
         <script src="<?php echo assets_url('vendor/perfect-scrollbar/perfect-scrollbar.min.js'); ?>"></script>
         <script src="<?php echo assets_url('vendor/switchery/switchery.min.js'); ?>"></script>
         <script src="<?php echo assets_url('vendor/jquery-cookie/jquery.cookie.js'); ?>"></script>
        <script src="<?php echo assets_url('vendor/purl/purl.js'); ?>"></script>
        <script src="<?php echo assets_url('assets/js/main.js'); ?>"></script>
        <script>
            jQuery(document).ready(function() {
                Main.init();
                <?php echo $additionalscript; ?>
            });
        </script>

        <!-- Extra javascript -->
        <?php echo $js; ?>
        <!-- / -->
    </body>
</html>