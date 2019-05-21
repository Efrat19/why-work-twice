{{--<script src="{{ asset('js/admin.js') }}" defer></script>--}}
{!! ssr('js/admin.js')->render() !!}
<div id="app">>>
    <h1>admin page</h1>
    <search url="/admin/search/users" result-type="user"></search>
    {{--<details>--}}
        {{--<summary>Users</summary>--}}
    {{--</details>--}}
    {{--<details>--}}
        {{--<summary>Homeworks</summary>--}}
    {{--</details>--}}
    {{--<details>--}}
        {{--<summary>Comments</summary>--}}

    {{--</details>--}}
    <button onclick="window.foo = 'bar'">clickme</button>
</div>
