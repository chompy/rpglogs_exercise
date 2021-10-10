<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ env('APP_NAME') }}</title>
        <link href="/css/app.css" rel="stylesheet" />
    </head>
    <body>
        <div id="container">
            <div id="head">
                <div class="left">
                    <a href="/" class="title">{{ env('APP_NAME') }}</a>
                </div>
                <div class="right">
                    <a href="https://github.com/chompy/rpglogs_exercise" target="_blank">
                        <img 
                            src="/img/github.png"
                            alt="github.com/chompy/rpglogs_exercise"
                            title="github.com/chompy/rpglogs_exercise"
                        />
                    </a>
                </div>
            </div>
            <div id="app"></div>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>