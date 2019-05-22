@extends('layouts.search', [ 'q' => $query])
@section('results')
    <ul>
        @foreach($results as $comment)
            <li class="list-group-item">
                comment: {{$comment['id']}}: {{$comment['header']}}, on homework {{$comment['homework_id']}} created by {{$comment['user']['name']}} at {{$comment['created_at']}}
                <a href="{{env('FRONTEND')}}/homeworks/{{$comment['homework_id']}}">go to homework</a>
            </li>
        @endforeach
    </ul>
@endsection
