@extends('layouts.app')
@section('content')
    <section class="add-comment">
        <form action="/admin/comment/{{$comment->id}}" method="POST">
            @method('PUT')
            @csrf
            <h4>Add Comment</h4>
            <div class="form-group">
                <label for="header">Header</label>
                <input type="text" class="form-control" id="header" name="header" placeholder="wtf" value="{{$comment->header}}">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" value="{{$comment->body}}"></textarea>
            </div>
            <button type="submit"  class="wwt-btn"  >Comment</button>
        </form>
    </section>
@endsection
