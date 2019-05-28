@extends('layouts.app')
@section('content')
<html>
<head>
</head>

<body>
<h1>Hi {{$user->name}}! (id {{$user->id}})</h1>
<h2>Welcome to wwt</h2>
<br/>
Your registered email-id is {{$user->email}}
</body>
@endsection

