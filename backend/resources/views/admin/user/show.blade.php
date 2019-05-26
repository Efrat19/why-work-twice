@extends('layouts.app')
@section('content')
                user: {{$user->id}}: {{$user->name}}, {{$user->email}}
                @can('update-user',$user)
                    <form action="/admin/user/{{$user->id}}/edit">
                        @csrf
                        @method('GET')
                        <button class="btn btn-warning">edit user</button>
                    </form>
                @endcan

                @can('delete-user',$user)
                    <form action="/admin/user/{{$user->id}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Delete</button>
                    </form>
                @endcan
@endsection
