@extends('layouts.search', ['q' => $query ,'resultType' => 'homework'])
@section('results')
    <ul>
        @foreach($results as $homework)
            <li class="list-group-item">
                homework: {{$homework['id']}}: {{$homework['description']}}, created by {{$homework['user']['name']}} at {{$homework['created_at']}}
                <a href="/admin/homework/{{$homework['id']}}">go to profile</a></li>

        @endforeach
    </ul>
@endsection
