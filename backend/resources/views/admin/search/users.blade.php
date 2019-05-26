@extends('layouts.search', ['q' => $query ,'resultType' => 'user'])

@section('results')
    <ul>
        @foreach($results as $user)
            <li class="list-group-item">
                user: {{$user['id']}}: {{$user['name']}}, {{$user['email']}}
                <a href="/admin/user/{{$user['id']}}">go to profile</a></li>
        @endforeach
    </ul>
@endsection
