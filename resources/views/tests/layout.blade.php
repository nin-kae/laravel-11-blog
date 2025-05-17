<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', '默认标题') - 我的应用</title>

    {{-- 其他 meta 标签, 字体链接等 --}}

    @vite(['resources/js/app.js']) {{-- <--- 确保这行存在！ --}}

    @stack('styles') {{-- 如果你使用 style stack --}}
</head>
<body>
<div id="app">
    {{-- 你的导航栏、内容等 --}}
    @yield('content')
</div>

{{-- 如果 Bootstrap JS 需要单独的 script 标签 (通常由 resources/js/bootstrap.js 处理) --}}
</body>
</html>
