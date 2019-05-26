@extends('layouts.search', ['q' => $query ,'resultType' => 'user'])

@section('results')
    <ul>
        @foreach($results as $user)
            <li class="list-group-item">
                user: {{$user['id']}}: {{$user['name']}}, {{$user['email']}} <a href="{{env('FRONTEND')}}/users/{{$user['id']}}">go to profile</a>
                @can('edit',$user)
                    <form action="/admin/user/{{$user['id']}}/edit">
                        @csrf
                        @method('GET')
                        <button class="btn btn-warning">edit user</button>
                    </form>
                @endcan
                @can('delete',$user)
                    <form action="/admin/user/{{$user['id']}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Delete</button>
                    </form>
                @endcan

            </li>
        @endforeach
    </ul>
@endsection
