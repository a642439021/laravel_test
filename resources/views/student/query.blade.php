@extends('layout')
@section('header')
@parent
我是新头部
@stop
@section('title')
    新的title
@stop
@section('content')
{{$name or '默认值'}}
{{date('Y-m-d')}}
@if (date('Y-m-d')=='2019-09-10')
    今天是教师节
@else
    今天不是教师节
@endif
@stop