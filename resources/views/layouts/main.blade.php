<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- SITE META -->
    @yield('headContent')
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="{!! URL::to('images/favicon.ico') !!}" type="image/x-icon">

    <!-- TEMPLATE STYLES -->
    <link rel="stylesheet" type="text/css" href="{!! URL::to('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! URL::to('style.css') !!}">
    <link rel="stylesheet" type="text/css" href="{!! URL::to('css/colors.css') !!}">

    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
@include('layouts.header')
@yield('bodyContent')
<hr>
@include('layouts.footer')

<script src="{!! URL::to('js/jquery.min.js') !!}"></script>
<script src="{!! URL::to('js/bootstrap.js') !!}"></script>
<script src="{!! URL::to('js/plugins.js') !!}"></script>
<script src="{!! URL::to('js/isotope.js') !!}"></script>
<script src="{!! URL::to('js/imagesloaded.pkgd.js') !!}"></script>
<script src="{!! URL::to('js/portfolio.js') !!}"></script>

</body>
</html>