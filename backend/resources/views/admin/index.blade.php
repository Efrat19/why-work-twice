@extends('layouts.app')
@section('content')

            {{--<div class="col-md-8">--}}
                        <h3 style="color: white"> what whuld you like to do today?</h3></div>
        <ul>
            @foreach($links as $link => $label)
                <li class="list-group-item">
                    <a href="{{$link}}">{{$label}}</a>
                </li>
            @endforeach
        </ul>
@endsection
