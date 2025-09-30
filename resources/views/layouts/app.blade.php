<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <style>
            body{overflow-x:hidden; position:relative;}
            #plane-smoke {position:fixed; width:100vw; height:100vh; top:0; left:0; background: radial-gradient(circle, rgba(200,200,200,0.1) 0%, rgba(200,200,200,0.8) 70%, rgba(200,200,200,1) 100%); z-index:9999; pointer-events:none; opacity:0; transform:scale(0);}
            @keyframes smoke-fill {
                0% {opacity:0; transform:scale(0);}
                50% {opacity:1; transform:scale(1.2);}
                100% {opacity:1; transform:scale(1);}
            }
        </style>


    </head>
    <body>
        <div id="app">
            @include('../front/header')

            <main id="ajax-content">
                {!! $content ?? '' !!}
            </main>

            <div id="plane-smoke"></div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
            const contentDiv = document.getElementById('ajax-content');
            const smoke = document.getElementById('plane-smoke');

            function attachAjaxLinks(parent=document){
                const ajaxLinks = parent.querySelectorAll('.ajax-link');
                ajaxLinks.forEach(link=>{
                link.removeEventListener('click', link._ajaxHandler);
                link._ajaxHandler = function(e){
                    e.preventDefault();
                    loadPage(this.href);
                };
                link.addEventListener('click', link._ajaxHandler);
                });
            }

            function loadPage(url, pushState=true){
                smoke.style.display='block';
                smoke.style.opacity=1;
                smoke.style.animation='smoke-fill 2.5s ease forwards';
                contentDiv.style.visibility='hidden';

                setTimeout(()=>{
                fetch(url,{headers:{'X-Requested-With':'XMLHttpRequest'}})
                    .then(res=>res.text())
                    .then(html=>{
                    contentDiv.innerHTML = html;
                    attachAjaxLinks(contentDiv);
                    contentDiv.style.visibility='visible';

                    if(pushState) history.pushState(null,'',url);

                    smoke.style.opacity=0; smoke.style.animation='';
                    });
                },1500); // wait for animation
            }

            attachAjaxLinks();
            window.addEventListener('popstate', ()=>loadPage(location.href,false));
            });
            </script>

    </body>
</html>
