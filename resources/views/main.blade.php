<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Simple Todo List</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

<div class="container mx-auto px-6 py-12 max-w-screen-lg">
    @yield('content')
</div>

</body>
</html>
