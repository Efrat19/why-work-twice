<div class="container">
    <div class="row justify-content-center">
            <form action="{{$url}}" class="form-inline md-form mr-auto mb-4">
                @csrf
                <input class="form-control mr-md-4" type="text" name="q" placeholder="Search" aria-label="Search" value="{{$q}}">
                <button class="btn btn-outline-warning btn-rounded btn-sm my-0" type="submit">Go</button>
            </form>
    </div>
    <div class="row justify-content-center">
        @yield('results')
    </div>
</div>
