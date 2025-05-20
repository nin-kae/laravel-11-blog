@extends('layouts.default')
@section('title', $title)

@section('content')
    <div class="offset-md-2 col-md-8">
        <h2 class="mb-4 text-center">{{ $title }}</h2>

        <div class="list-group list-group-flush">
            @foreach ($users as $user)
                <div class="list-group-item d-flex align-items-center">
                    <a href="{{ route('users.show', $user) }}" class="me-3 flex-shrink-0">
                        <img class="rounded-circle" src="{{ $user->gravatar(32) }}" alt="{{ $user->name }}"
                             style="width: 32px; height: 32px; display: block;">
                    </a>
                    <a class="text-decoration-none fw-bold me-auto" href="{{ route('users.show', $user) }}">
                        {{ $user->name }}
                    </a>
                    <small class="text-muted ms-2">
                        最后活跃于: {{ $user->updated_at->diffForHumans() }}
                    </small>
                </div>

            @endforeach
        </div>

        <div class="mt-3">
            {!! $users->links() !!}
        </div>
    </div>
@stop
