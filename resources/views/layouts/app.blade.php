<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" type="image/png">

    <!-- Fonts & Bootstrap -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div id="app">
        @include('front.header')

        <main id="ajax-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const contentDiv = document.getElementById('ajax-content');

        function loadPage(url, pushState = true) {
            fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } })
                .then(r => r.text())
                .then(html => {
                    contentDiv.innerHTML = html;
                    attachAjaxLinks(contentDiv);
                    if(pushState) history.pushState({}, "", url);
                });
        }

        function attachAjaxLinks(parent = document) {
            parent.querySelectorAll('a.ajax-link').forEach(link => {
                link.onclick = function(e){
                    if(e.button === 0 && !e.metaKey && !e.ctrlKey && !e.shiftKey){
                        e.preventDefault();
                        loadPage(this.href);
                    }
                }
            });
        }

        attachAjaxLinks();
        window.addEventListener('popstate', () => loadPage(location.href, false));
    });
    </script>
</body>
</html>
