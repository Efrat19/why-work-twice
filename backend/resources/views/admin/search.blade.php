<section class="search">
    <form action="{{ $url }}">
        @csrf
        <input type="text" class="wwt-input bar form-control"
              oninput="submit" placeholder="{{'search'.$resultType.'s...'}}">
        <div class="results">
            @foreach($results as $result)
                @include('admin.'.$resultType.'-result', ['result' => $result])
            @endforeach
        </div>
    </form>
    </section>
