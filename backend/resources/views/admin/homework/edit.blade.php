@extends('layouts.app')
@section('content')
    <section class="add-homework">
        <form action="/admin/homework/{{$homework->id}}"  method="POST">
            @csrf
            @method('PUT')
            <h4>Edit Homework</h4>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{$homework->description}}">
            </div>
            <div class="form-group">
                <label for="school">School</label>
                <input type="text" class="form-control" id="school" name="school" value="{{$homework->school->name}}">
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject" value="{{$homework->subject->name}}">
            </div>
            <div class="form-group">
                <label for="source">Source</label>
                <div class="wwt-btn">
                    <label for="source">Upload again</label>
                    <input type="file" class="inner-upload" id="source" name="source" @change="setSource($event)" value="{{$homework->source}}">
                </div>
            </div>
            <button type="submit"  class="wwt-btn"  >Change Homework</button>
        </form>
    </section>
@endsection
