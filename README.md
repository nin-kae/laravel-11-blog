# Build a blog with Laravel 11.*

## 📅 2025/05/09

#### 今天运行的代码

1. 创建静态页面

    - 创建一个新的分支
        ```bash
        git checkout -b static-pages
        ```

    - 删除无用的页面
        ```bash
        rm resources/views/welcome.blade.php
        ```

    - 生成静态页面用的控制器
        ```bash
        php artisan make:controller StaticPagesController
        ```
    - 生成静态页面用的视图
        ```bash
        php artisan make:view static_pages/home
        php artisan make:view static_pages/help
        php artisan make:view static_pages/about
        ```
    - 做完以上的操作之后, 提交
        ```bash
        git add .
        git commit -m "创建静态页面"
        ```

2. 模板切分

    - 生成布局文件
        ```bash
        php artisan make:view layouts/default
        ```
    - 生成导航栏
        ```bash
        git add .
        git commit -m "模板切分"
        ```
    - 可以通过以下命令查看所有的命令
        ```bash
        php artisan list
        ```

- 提交代码到远程仓库
    ```bash
    git checkout main
    git merge static-pages
    git push
    ```
