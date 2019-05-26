@extends('layouts.app')
@section('content')
    <section class="add-comment">
        <form action="/admin/comment" method="POST">
            @csrf
            <h4>Add Comment</h4>
            <div class="form-group">
                <label for="header">Header</label>
                <input type="text" class="form-control" id="header" name="header" placeholder="wtf">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body" placeholder="drop it all here..."></textarea>
            </div>
            <button type="submit"  class="wwt-btn"  @click.prevent="submit">Comment</button>
        </form>
    </section>
@endsection
