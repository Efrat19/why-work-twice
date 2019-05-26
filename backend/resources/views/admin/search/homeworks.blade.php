@extends('layouts.search', ['q' => $query ,'resultType' => 'homework'])
@section('results')
    <ul>
        @foreach($results as $homework)
            <li class="list-group-item">
                homework: {{$homework['id']}}: {{$homework['description']}}, created by {{$homework['user']['name']}} at {{$homework['created_at']}}
                <a href="{{env('FRONTEND')}}/homeworks/{{$homework['id']}}">go to homework</a>
                @can('edit',$homework)
                    <form action="/admin/homework/{{$homework['id']}}/edit">
                        @csrf
                        @method('GET')
                        <button class="btn btn-warning">edit homework</button>
                    </form>
                @endcan
                @can('delete',$homework)
                    <form action="/admin/homework/{{$homework['id']}}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Delete</button>
                    </form>
                @endcan

            </li>
        @endforeach
    </ul>
@endsection
