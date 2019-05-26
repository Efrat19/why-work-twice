@extends('layouts.search', ['q' => $query ,'resultType' => 'comment'])
@section('results')
    <ul>
        @foreach($results as $comment)
            <li class="list-group-item">
                comment: {{$comment['id']}}: {{$comment['header']}}, on homework {{$comment['homework_id']}} created by {{$comment['user']['name']}} at {{$comment['created_at']}}

            <a href="/admin/comment/{{$comment['id']}}">go to profile</a></li>
            </li>
        @endforeach
    </ul>
@endsection
