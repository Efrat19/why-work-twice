@extends('layouts.app')
@section('content')
                homework: {{$homework->id}}: {{$homework->name}}, {{$homework->email}}
                @can('update-homework',$homework)
                    <form action="/admin/homework/{{$homework->id}}/edit"  method="POST">
                        @csrf
                        @method('GET')
                        <button class="btn btn-warning">edit homework</button>
                    </form>
                @endcan

                @can('delete-homework',$homework)
                    <form action="/admin/homework/{{$homework->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-warning">Delete</button>
                    </form>
                @endcan
@endsection
