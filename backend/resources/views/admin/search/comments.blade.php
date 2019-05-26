@extends('layouts.search', ['q' => $query ,'resultType' => 'comment'])
@section('results')
    <ul>
        @foreach($results as $comment)
            <li class="list-group-item">
                comment: {{$comment['id']}}: {{$comment['header']}}, on homework {{$comment['homework_id']}} created by {{$comment['user']['name']}} at {{$comment['created_at']}}
{{--                <a href="{{env('FRONTEND')}}/homeworks/{{$comment['homework_id']}}">go to homework</a>--}}
                @can('edit',$comment)
                    <form action="/admin/comment/{{$comment['id']}}/edit">
                        @csrf
                        @method('GET')
                        <button class="btn btn-warning">edit comment</button>
                    </form>
                    @endcan
@can('delete',$comment)
                    <form action="/admin/comment/{{$comment['id']}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Delete</button>
                    </form>
                    @endcan
            </li>
        @endforeach
    </ul>
@endsection
