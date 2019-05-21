<script src="{{ asset('js/admin.js') }}" defer></script>
<div id="app">
    <h1>admin page</h1>
    <details>
        <summary>Users</summary>
        @include('admin.search',['url' => $baseUrl.'/users', 'resultType' => 'user'])
    </details>
    <details>
        <summary>Homeworks</summary>
    </details>
    <details>
        <summary>Comments</summary>

    </details>
    <button onclick="window.foo = 'bar'">clickme</button>
</div>
