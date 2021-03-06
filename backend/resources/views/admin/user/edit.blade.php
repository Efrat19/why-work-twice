@extends('layouts.app')
@section('content')

    <section class="edit-profile">
        <form action="/admin/user/{{$user->id}}" method="POST">
            @csrf
@method('PUT')
            <label for="exampleInputName">Your Name:</label>
            <input type="text" class="form-control" id="exampleInputName" placeholder="Efrat" name="name" value="{{$user->name}}">
            <div class="form-group">
                <label for="exampleInputSchool">Where Do You Study?</label>
                <input type="text" class="form-control" id="exampleInputSchool" name="subject" value="{{$user->subject->name}}">
            </div>
            <div class="form-group">
                <label for="exampleInputSubject">What Exactly Are You Studying now?</label>
                <input type="text" class="form-control" id="exampleInputSubject"  name="school" value="{{$user->school->name}}">
            </div>
            <button type="submit"  class="wwt-btn"  >Save Changes</button>
        </form>
    </section>
@endsection
