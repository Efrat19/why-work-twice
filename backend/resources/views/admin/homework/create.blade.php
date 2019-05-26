@extends('layouts.app')
@section('content')
    <section class="add-homework">
        <form action="/admin/homework" method="POST">

@csrf            <h4>Add Homework</h4>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="my homework">
            </div>
            <div class="form-group">
                <label for="school">School</label>
                <input type="text" class="form-control" id="school" name="school" placeholder="my school">
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="my subject">
            </div>
            <div class="form-group">
                <label for="source">Source</label>
                <div class="wwt-btn">
                    <label for="source">Upload file</label>
                    <input type="file" class="inner-upload" id="source" name="source" @change="setSource($event)">
                </div>
            </div>
            <button type="submit"  class="wwt-btn"  >Add Homework</button>
        </form>
    </section>
@endsection
