<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/custom-css/@yield('url-css')">
</head>
<style stype="text/css">
    @font-face {
        font-family: "montserrat";
        src: url('/font/Montserrat-Regular.ttf');
    }

    @font-face {
        font-family: "nunito";
        src: url('/font/Nunito-Regular.ttf');
    }

    @font-face {
        font-family: "firaCode";
        src: url('/font/FiraCode-Regular.ttf');
    }

</style>

<body>
    <div id="app">
        @yield('content')
    </div>

    <script src="/js/jquery-3.5.1.slim.min.js">
    </script>
    <script src="/js/popper.min.js">
    </script>
    <script src="/js/bootstrap.min.js">
    </script>
</body>

</html>
