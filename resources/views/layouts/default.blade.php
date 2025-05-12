<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Weibo App') - Laravel blog</title>
    {{-- vite 是引用 resource 下的 css & js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Lu Stormstout</a>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item"><a class="nav-link" href="/help">Help</a></li>
            <li class="nav-item" ><a class="nav-link" href="#">Login</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>
