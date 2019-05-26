@extends('layouts.app')
@section('content')
    <section class="register">
        <form action="/admin/user" method="POST">
            <div class="form-group">
                <label for="exampleInputName">Whats Your Name?</label>
                <input type="text" class="form-control" id="exampleInputName" placeholder="Efrat" name="name">
            </div>
            <div>
                <label for="exampleInputEmail1">And Your Email?</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="your@email.com" name="email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputSchool">Where Do You Study?</label>
                <input type="text" class="form-control" id="exampleInputSchool" name="subject">
            </div>
            <div class="form-group">
                <label for="exampleInputSubject">What Exactly Are You Studying now?</label>
                <input type="text" class="form-control" id="exampleInputSubject"  name="school">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hit Your Password...</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword2">Again Please....</label>
                <input type="password" class="form-control" id="exampleInputPassword2" name="confirmPassword">
            </div>
            <button type="submit" class="wwt-btn" @click.prevent="submit">Sign In</button>
        </form>

    </section>
@endsection
