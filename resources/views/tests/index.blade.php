@extends('tests.layout')

@section('title', '组合组件测试页面')

@section('content')
    {{-- 整个页面的包裹容器，应用之前在 body 上设置的背景色 --}}
    {{-- 如果你的 'tests.layout' 已经在 <body> 上设置了背景色，或者有自己的主内容包裹元素，可以调整或移除这个 div --}}
    <div class="tw-bg-gray-50">

        <nav class="navbar navbar-expand-lg navbar-light tw-bg-white tw-shadow-md tw-py-3 sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand tw-font-extrabold tw-text-2xl tw-bg-clip-text tw-text-transparent tw-bg-gradient-to-r tw-from-purple-600 tw-to-pink-500" href="#">
                    时尚品牌
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavModern" aria-controls="navbarNavModern" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavModern">
                    <ul class="navbar-nav ms-auto tw-items-center">
                        <li class="nav-item">
                            <a class="nav-link active tw-text-purple-600 tw-font-semibold tw-mx-2 tw-px-3 tw-py-2 hover:tw-text-pink-500 tw-transition-colors" aria-current="page" href="#hero">首页</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tw-text-gray-700 tw-font-medium tw-mx-2 tw-px-3 tw-py-2 hover:tw-text-pink-500 tw-transition-colors" href="#products">特色商品</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tw-text-gray-700 tw-font-medium tw-mx-2 tw-px-3 tw-py-2 hover:tw-text-pink-500 tw-transition-colors" href="#contact">联系我们</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="btn btn-outline-primary tw-ml-2 tw-border-purple-500 tw-text-purple-500 hover:tw-bg-purple-500 hover:tw-text-white tw-font-semibold tw-py-2 tw-px-4 tw-rounded-lg tw-transition-all tw-duration-200">
                                登录
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <section id="hero" class="tw-bg-gradient-to-r tw-from-slate-900 tw-to-slate-800 tw-text-white tw-py-20 md:tw-py-32">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 text-center text-lg-start">
                        <h1 class="display-4 fw-bold lh-1 mb-3 tw-text-5xl md:tw-text-6xl tw-font-extrabold tw-mb-6">
                            <span class="tw-text-transparent tw-bg-clip-text tw-bg-gradient-to-r tw-from-sky-400 tw-to-cyan-300">下一代</span>
                            创新平台
                        </h1>
                        <p class="lead tw-text-lg tw-text-slate-300 tw-mb-8 md:tw-pr-12">
                            探索无限可能，与我们一起构建未来。我们提供最先进的工具和服务，助您实现创意和商业目标。
                        </p>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                            <a href="#" class="btn btn-primary btn-lg px-4 me-md-2 tw-bg-sky-500 hover:tw-bg-sky-600 tw-border-sky-500 hover:tw-border-sky-600 tw-text-white tw-font-semibold tw-py-3 tw-px-6 tw-rounded-lg tw-shadow-lg hover:tw-shadow-xl tw-transform hover:tw-scale-105 tw-transition-all tw-duration-200">
                                立即开始
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-lg px-4 tw-text-slate-300 tw-border-slate-400 hover:tw-bg-slate-700 hover:tw-text-white tw-font-semibold tw-py-3 tw-px-6 tw-rounded-lg tw-transition-colors tw-duration-200">
                                了解更多
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-5 tw-hidden lg:tw-block tw-mt-10 lg:tw-mt-0">
                        <img src="{{ asset('favicon.ico') }}" class="tw-rounded-xl tw-shadow-2xl" alt="Hero Image">
                    </div>
                </div>
            </div>
        </section>


        <section id="products" class="tw-py-16 tw-bg-slate-100">
            <div class="container">
                <h2 class="tw-text-4xl tw-font-bold tw-text-center tw-text-gray-800 tw-mb-12">特色商品</h2>
                <div class="row g-4 justify-content-center">
                    {{-- 商品卡片 1 --}}
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                        <div class="card tw-rounded-xl tw-shadow-lg hover:tw-shadow-2xl tw-transition-shadow tw-duration-300 tw-ease-in-out tw-overflow-hidden tw-w-full">
                            <img src="{{ asset('favicon.ico') }}" class="card-img-top tw-object-cover" alt="商品图片1">
                            <div class="card-body tw-flex tw-flex-col">
                                <h5 class="card-title tw-text-xl tw-font-semibold tw-text-gray-800 tw-mb-2">炫酷商品壹号</h5>
                                <p class="card-text tw-text-gray-600 tw-text-sm tw-mb-4">
                                    这是壹号商品的简短描述，突出其主要特点和优势。
                                </p>
                                <div class="tw-mt-auto">
                                    <a href="#" class="btn btn-primary tw-w-full tw-bg-blue-600 hover:tw-bg-blue-700 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded-lg tw-transition-colors tw-duration-150">
                                        查看详情
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 商品卡片 2 --}}
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                        <div class="card tw-rounded-xl tw-shadow-lg hover:tw-shadow-2xl tw-transition-shadow tw-duration-300 tw-ease-in-out tw-overflow-hidden tw-w-full">
                            <img src="{{ asset('favicon.ico') }}" class="card-img-top tw-object-cover" alt="商品图片2">
                            <div class="card-body tw-flex tw-flex-col">
                                <h5 class="card-title tw-text-xl tw-font-semibold tw-text-gray-800 tw-mb-2">潮流商品贰号</h5>
                                <p class="card-text tw-text-gray-600 tw-text-sm tw-mb-4">
                                    这是贰号商品的简短描述，质量上乘，设计新颖。
                                </p>
                                <div class="tw-mt-auto">
                                    <a href="#" class="btn btn-primary tw-w-full tw-bg-green-600 hover:tw-bg-green-700 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded-lg tw-transition-colors tw-duration-150">
                                        立即购买
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 商品卡片 3 --}}
                    <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                        <div class="card tw-rounded-xl tw-shadow-lg hover:tw-shadow-2xl tw-transition-shadow tw-duration-300 tw-ease-in-out tw-overflow-hidden tw-w-full">
                            <img src="{{ asset('favicon.ico') }}" class="card-img-top tw-object-cover" alt="商品图片3">
                            <div class="card-body tw-flex tw-flex-col">
                                <h5 class="card-title tw-text-xl tw-font-semibold tw-text-gray-800 tw-mb-2">精品商品叁号</h5>
                                <p class="card-text tw-text-gray-600 tw-text-sm tw-mb-4">
                                    这是叁号商品的简短描述，性价比之选，不容错过。
                                </p>
                                <div class="tw-mt-auto">
                                    <a href="#" class="btn btn-primary tw-w-full tw-bg-purple-600 hover:tw-bg-purple-700 tw-text-white tw-font-bold tw-py-2 tw-px-4 tw-rounded-lg tw-transition-colors tw-duration-150">
                                        加入购物车
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="contact" class="tw-py-16 tw-bg-sky-50">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-7">
                        <div class="tw-bg-gradient-to-br tw-from-white tw-to-blue-100 tw-p-6 md:tw-p-10 tw-rounded-xl tw-shadow-xl">
                            <h2 class="tw-text-3xl tw-font-bold tw-text-center tw-text-gray-800 tw-mb-8">联系我们</h2>
                            <form>
                                <div class="mb-3">
                                    <label for="contactName" class="form-label tw-text-gray-700 tw-font-medium">姓名</label>
                                    <input type="text" class="form-control tw-py-2.5 tw-px-4 tw-border-gray-300 focus:tw-ring-2 focus:tw-ring-blue-500 focus:tw-border-transparent tw-rounded-md tw-transition-all" id="contactName" placeholder="请输入您的姓名">
                                </div>
                                <div class="mb-3">
                                    <label for="contactEmail" class="form-label tw-text-gray-700 tw-font-medium">电子邮件</label>
                                    <input type="email" class="form-control tw-py-2.5 tw-px-4 tw-border-gray-300 focus:tw-ring-2 focus:tw-ring-blue-500 focus:tw-border-transparent tw-rounded-md tw-transition-all" id="contactEmail" placeholder="name@example.com">
                                </div>
                                <div class="mb-4">
                                    <label for="contactMessage" class="form-label tw-text-gray-700 tw-font-medium">消息</label>
                                    <textarea class="form-control tw-py-2.5 tw-px-4 tw-border-gray-300 focus:tw-ring-2 focus:tw-ring-blue-500 focus:tw-border-transparent tw-rounded-md tw-transition-all" id="contactMessage" rows="4" placeholder="请输入您的留言"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success tw-w-full tw-bg-green-500 hover:tw-bg-green-600 tw-text-white tw-font-bold tw-py-3 tw-px-4 tw-rounded-lg tw-shadow-md hover:tw-shadow-lg tw-transition-all tw-duration-150">
                                    发送消息
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer tw-bg-gray-800 tw-text-gray-300 tw-py-8">
            <div class="container text-center">
                <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" class="brand-icon d-inline-block align-text-top" style="width: 17px; height: 17px; margin-right: 5px;">
                由 <a href="https://laravel.com/" target="_blank" class="text-decoration-none tw-text-pink-400 hover:tw-text-pink-300">Laravel</a> 强力驱动
                <div class="float-none mt-2 mt-md-0 md:float-end">
                    <a href="#" class="text-decoration-none tw-text-gray-400 hover:tw-text-gray-200">关于我们</a>
                </div>
            </div>
        </footer>

    </div>{{-- 结束 .tw-bg-gray-50 包裹 div --}}
@endsection

@push('scripts')
    {{-- 如果 tests.layout.blade.php 使用了 @stack('scripts') 来加载页面特定的 JavaScript --}}
    {{-- 并且你的 Bootstrap JS 初始化较为复杂或需要特定于此页面的逻辑，可以放在这里 --}}
    {{-- 但通常情况下，Bootstrap JS 的全局初始化在 resources/js/bootstrap.js 中完成，并通过 @vite 引入 --}}
    <script>
        // 此处可以放置特定于此页面的 JavaScript（如果需要）
        // 例如，手动初始化某些 Bootstrap 组件，尽管通常不需要
        // var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        // var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        //   return new bootstrap.Popover(popoverTriggerEl)
        // })
    </script>
@endpush
