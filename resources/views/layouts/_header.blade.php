<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container ">
        <a class="navbar-brand" href="/">{{ config("app.name", "Lu Stormstout") }}</a>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item"><a class="nav-link" href="{{ route("help") }}">Help</a></li>
            <li class="nav-item" ><a class="nav-link" href="#">Login</a></li>
        </ul>
    </div>
</nav>
