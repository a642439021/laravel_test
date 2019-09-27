<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>表单提交-@yield('title')</title>
    @section('style')
    @show
</head>
<body>
@section('header')
    <div>
        <h1>轻松学会laravel</h1>
        <p>-玩转laravel表单</p>
    </div>
@show
@section('leftmenu')
<ul>
    <li><a href="">学生列表</a></li>
    <li><a href="">新增会员</a></li>
</ul>
@show
@yield('content')

@section('footer')
@show
@section('javascript')
@show
</body>
</html>
