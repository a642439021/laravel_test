<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title>我的广场@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}">
    <script src="{{ asset('js/jquery.min.2.1.1.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/swiper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('layer/layer.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <script src="{{ asset('layui/layui.js') }}"></script>
</head>
<body>
@yield('content')
</body>
</html>
