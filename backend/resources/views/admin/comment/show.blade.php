@extends('layouts.app')
@section('content')
                comment: {{$comment->id}}: {{$comment->name}}, {{$comment->email}}
                @can('update-comment',$comment)
                    <form action="/admin/comment/{{$comment->id}}/edit"  method="POST">
                        @csrf
                        @method('GET')
                        <button class="btn btn-warning">edit comment</button>
                    </form>
                @endcan

                @can('delete-comment',$comment)
                    <form action="/admin/comment/{{$comment->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Delete</button>
                    </form>
                @endcan
@endsection
