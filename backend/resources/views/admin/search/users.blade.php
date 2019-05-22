@extends('layouts.search', [  'q' => $query])

@section('results')
    <ul>
        @foreach($results as $user)
            <li class="list-group-item">
                user: {{$user['id']}}: {{$user['name']}}, {{$user['email']}} <a href="{{env('FRONTEND')}}/users/{{$user['id']}}">go to profile</a>
            </li>
        @endforeach
    </ul>
@endsection
