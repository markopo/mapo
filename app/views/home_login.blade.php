@extends('layout')

@section('content')
        <h2>Login</h2>

        <div class="error">
            {{ isset($errormessage) ? $errormessage : "" }}
        </div>

        <form action="logon" method="post">
            <input type="text" id="username" name="username" value="" >
            <input type="password" id="password" name="password" value="" >
            <input type="submit" value="login" >
        </form>



@stop