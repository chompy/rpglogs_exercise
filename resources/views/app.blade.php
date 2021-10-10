<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Nathan RPGLogs Exercise</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    </head>
    <body>
        <div id="container">
            <div id="head">
                <a href="/" class="title">Nathan RPGLogs Exercise</a>
            </div>

            <div id="app"></div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>