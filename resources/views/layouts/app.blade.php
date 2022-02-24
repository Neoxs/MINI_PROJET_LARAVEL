<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="PRAGMA" content="NO-CACHE">
    <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
    <meta http-equiv="EXPIRES" content="0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/icons/lms-icon.svg') }}" type="image/x-icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>ESI LIB</title>
</head>
<body>
        <!-- Stuff will be rendered here -->
            @yield('root')

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>