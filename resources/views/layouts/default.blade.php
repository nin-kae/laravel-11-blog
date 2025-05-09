<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title', config('app.name', 'Nin kae'))</title>
</head>
<body>
@yield('content')
</body>
</html>
