@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="form-inline md-form mb-4" style="margin-top: 300px ">
                @csrf
                <input class="form-control mr-lg-4" type="text" name="q" placeholder="Search" aria-label="Search" value="{{$query}}">
                <button class="btn btn-outline-warning btn-rounded btn-sm my-0" type="submit">Go</button>
            </form>
        </div>
        <div class="row justify-content-center">
            @yield('results')
        </div>
    </div>
    @endsection
