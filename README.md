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
## 📅 2025/05/09

- 创建一个新的分支
    ```bash
    git checkout main
    git checkout -b filling-layout-style
    ```
- 安装 laravel/ui
    ```bash
    composer require laravel/ui
    php artisan ui bootstrap
    ```

- 处理静态资源加载的问题,确认安装了 bootstrap sass
    ```bash
    npm install bootstrap sass --save-dev
    ```

- 提交初始化样式
    ```bash
    git add .
    git commit -m "初始化样式"
    ```

- 完成拆分 _header.blade.php 和 _footer.blade.php
    ```bash
    git add .
    git commit -m "完成拆分 _header.blade.php 和 _footer.blade.php"
    ```

- 完成 logo 引入以及跳转链接使用 route
    ```bash
    git add .
    git commit -m "完成 logo 引入以及跳转链接使用 route"
    ```

- 完成注册页面
    ```bash
    git add .
    git commit -m "完成注册页面"
    ```

- 合并分支
    ```bash
    git checkout main
    git merge filling-layout-style
    git push
    ```
