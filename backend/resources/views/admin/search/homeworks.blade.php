@extends('layouts.search', ['url' => $url, 'q' => $query])
@section('results')
    <ul>
        @foreach($results as $homework)
            <li class="list-group-item">
                homework: {{$homework['id']}}: {{$homework['description']}}, created by {{$homework['user']['name']}} at {{$homework['created_at']}}
                <a href="{{env('FRONTEND')}}/homeworks/{{$homework['id']}}">go to homework</a>
            </li>
        @endforeach
    </ul>
@overwrite
