<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 8/21/15
 * Time: 10:37 AM
 */
 ?>
 <!DOCTYPE html>
 <html lang="zh-CN">
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">

 	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
 	<meta name="description" content="Xenon Boostrap Admin Panel" />
 	<meta name="author" content="" />

 	<title>Xenon - Login</title>

 	{!! Html::style("style/assets/css/fonts/linecons/css/linecons.css") !!}
 	{!! Html::style("style/assets/css/fonts/fontawesome/css/font-awesome.min.css") !!}
 	{!! Html::style("style/assets/css/bootstrap.css") !!}
 	{!! Html::style("style/assets/css/xenon-core.css") !!}
 	{!! Html::style("style/assets/css/xenon-forms.css") !!}
 	{!! Html::style("style/assets/css/xenon-components.css") !!}
 	{!! Html::style("style/assets/css/xenon-skins.css") !!}
 	{!! Html::style("style/assets/css/custom.css") !!}

    {!! Html::script("style/assets/js/jquery-1.11.1.min.js") !!}

 	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
 	<!--[if lt IE 9]>
        {!! Html::script("https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js") !!}
        {!! Html::script("https://oss.maxcdn.com/respond/1.4.2/respond.min.js") !!}
 	<![endif]-->


 </head>
 <body class="page-body login-page">


 @yield('container')



 <!-- Bottom Scripts -->
 {!! Html::script("style/assets/js/bootstrap.min.js") !!}

 {!! Html::script("style/assets/js/TweenMax.min.js") !!}
 {!! Html::script("style/assets/js/resizeable.js") !!}
 {!! Html::script("style/assets/js/joinable.js") !!}
 {!! Html::script("style/assets/js/xenon-api.js") !!}
 {!! Html::script("style/assets/js/xenon-toggles.js") !!}
 {!! Html::script("style/assets/js/toastr/toastr.min.js") !!}

 @yield('script')

 <!-- JavaScripts initializations and stuff -->
 {!! Html::script("style/assets/js/xenon-custom.js") !!}

 </body>
 </html>