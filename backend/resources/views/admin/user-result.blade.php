
    <section class="user-search-result">
        <details>
            <summary>{{getSummary}}
                <router-link to="{{`/user/${result.id}`}}">profile page</router-link>
            </summary>
                @if($result->canEdit)
                    <button onclick="">Edit User</button>
                @endif

            {{--@if($result->canDelete)--}}
            {{--<button></button>--}}
                {{--@endif--}}
        </details>
    </section>
