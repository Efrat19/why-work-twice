@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="form-inline md-form mb-4" action="/admin/new-admin" style="margin-top: 100px ">
                @csrf
                <label for="newadmin" class="white-label">add new admin:</label>
                <input id="newadmin" class="form-control mr-lg-4" type="text" name="newadmin" placeholder="user id">
                <button class="btn btn-outline-warning btn-rounded btn-sm my-0" type="submit">Go</button>
            </form>
        </div>
        {{--<div class="row justify-content-center">--}}
            @foreach($users as $user)
                    <li class="list-group-item {{$user->isSuperAdmin()?'list-group-item-warning':''}}">
                        <b>{{$user->isSuperAdmin()?'super admin':'admin'}}:  </b> {{$user->id}}: {{$user->name}},
                        <a href="http://{{env('FRONTEND')}}/users/{{$user['id']}}">go to profile</a>
                        <a class="btn btn-secondary admin-btn" href="/admin/degrade/{{$user->id}}">degrade privilege</a>
                        @if(!$user->isSuperAdmin())
                            <a class="btn btn-warning admin-btn" href="/admin/elevate/{{$user->id}}">elevate privilege</a>
                        @endif
                        <div class="cb" style="clear: both"></div>
                    </li>
            @endforeach
        {{--</div>--}}
    </div>
@endsection
