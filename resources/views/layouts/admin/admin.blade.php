<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="慕庄－后台管理系统" />
	<meta name="author" content="Mr.lv" />
	
	<title>陆风汽车－微信后台管理系统</title>

    {!! Html::style('style/assets/css/fonts/linecons/css/linecons.css') !!}
    {!! Html::style('style/assets/css/fonts/linecons/css/linecons.css') !!}
    {!! Html::style('style/assets/css/fonts/fontawesome/css/font-awesome.min.css') !!}
    {!! Html::style('style/assets/css/bootstrap.css') !!}
    {!! Html::style('style/assets/css/xenon-core.css') !!}
    {!! Html::style('style/assets/css/xenon-forms.css') !!}
    {!! Html::style('style/assets/css/xenon-components.css') !!}
    {!! Html::style('style/assets/css/xenon-skins.css') !!}
    {!! Html::style('style/assets/css/custom.css') !!}

    {!! Html::script('style/assets/js/jquery-1.11.1.min.js') !!}

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
</head>
<body class="page-body">

    {{--@include('layouts.admin.header')--}}
	
	<div class="page-container">
        <!--inlcude sidebar-->
        @include('layouts.admin.sidebar')
		<!-- main content-->
		<div class="main-content">
            <!--navbar-->
			@include('layouts.admin.navbar')
            @include('layouts.admin.breadcrumb')

            @yield('flash-message')
            <!--content-->
            @yield('content')

            @include('layouts.admin.footer')
		</div>

	</div>
	
	@yield('other')
	



    <!--Import styles on this page-->
    @yield('style')
    
	<!-- Bottom Scripts -->
    {!! Html::script('style/assets/js/bootstrap.min.js') !!}
    {!! Html::script('style/assets/js/TweenMax.min.js') !!}
    {!! Html::script('style/assets/js/resizeable.js') !!}
    {!! Html::script('style/assets/js/joinable.js') !!}
    {!! Html::script('style/assets/js/xenon-api.js') !!}
    {!! Html::script('style/assets/js/xenon-toggles.js') !!}

    <!--Import script on this page-->
    @yield('script')

	<!-- JavaScripts initializations and stuff -->
    {!! Html::script('style/assets/js/xenon-custom.js') !!}


</body>
</html>