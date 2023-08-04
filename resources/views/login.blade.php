@extends('layout/layout-common')

@section('space-work')

<h1>Login</h1>
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p style="color: red">{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('userLogin') }}" method="POST">
@csrf

<input type="email" name="email" placeholder="Enter Email">
<br><br>
<input type="password" name="password" placeholder="Enter Password">
<br><br>
<input type="submit" value="Login">
</form>
<a href="/register">create new account</a>
<br><br>
<a href="/forget-password">Forget Password</a>

@if (Session::has('success'))
    <p style="color: green">{{Session::get('success')}}</p>
@endif

@endsection