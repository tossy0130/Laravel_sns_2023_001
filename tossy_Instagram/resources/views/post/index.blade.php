<!-- layout/app.blade.php を継承 -->
@extends('layouts.app')

<!-- navbar を　読み込み -->
@include('navbar')

@section('content')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


<a href="{{ route('logout') }}" class="btn btn-primary" 
onclick="event.preventDefault();document.getElementById('logout-form').submit();">サインアウト
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<p>このページは仮のトップページです。</p>
<a href="#" class="btn btn-primary">仮のボタンです</a>

@endsection

