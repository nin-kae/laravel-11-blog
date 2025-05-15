@extends('layouts.default')

@section('content')
    <div class="bg-light p-3 p-sm-5 rounded">
        <h1>Hello 👋</h1>
        <p class="lead">
            点开<a href="https://youtu.be/oIcYgrA_3hc"> 它 </a>你就能看到一个很好看的PV。
        </p>
        <p>
            一切，将从这里开始。
        </p>
        @if(!Auth::check())
            <p>
                <a class="btn btn-lg btn-success" href="{{ route('signup') }}" role="button">现在注册</a>
            </p>
        @endif
    </div>
@stop
