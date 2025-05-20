<div class="list-group-item d-flex align-items-center">
    <img class="me-3 rounded-circle" src="{{ $user->gravatar(32) }}" alt="{{ $user->name }}"
         style="width: 32px; height: 32px;">
    <a href="{{ route('users.show', $user) }}" class="text-decoration-none me-auto">
        {{ $user->name }}
    </a>
    @can('destroy', $user)
        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="ms-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
        </form>
    @endcan
</div>
