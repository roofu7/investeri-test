<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header>
    @include('includes.topnav')
</header>
@yield('layouts.content')
</body>
</html>
