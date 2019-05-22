@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="form-inline md-form mb-4" action="/admin/new-admin" style="margin-top: 300px ">
                @csrf
                <label for="newadmin">new admin:</label>
                <input id="newadmin" class="form-control mr-lg-4" type="text" name="newadmin" placeholder="user id">
                <button class="btn btn-outline-warning btn-rounded btn-sm my-0" type="submit">Go</button>
            </form>
        </div>
        <div class="row justify-content-center">
            @foreach($users as $user)
                <li class="list-group-item">
                    user: {{$user->id}}: {{$user->name}}, privilege: {{$user->isSuperAdmin()?'super admin':$user->isAdmin()?'admin':'standard'}}
                    @if(!$user->isSuperAdmin())
                        <a class="btn btn-secondary" href="/admin/elevate/{{$user->id}}">elevate privilege</a>
                        @endif
                        <a class="btn btn-secondary" href="/admin/degrade/{{$user->id}}">degrade privilege</a>
                    <a href="http://{{env('FRONTEND')}}/users/{{$user['id']}}">go to profile</a>
                </li>
            @endforeach
        </div>
    </div>
@endsection
