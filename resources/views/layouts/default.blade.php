<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Weibo App') - Laravel blog</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
@include('layouts._header')

<div class="container">

    @yield('content')

    @include('layouts._footer')

</div>
</body>
</html>
