<div class="list-group-item">
    <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="mr-3" width="32">
    <a href="{{ route('users.show', $user) }}">
        {{ $user->name }}
    </a>

    @can('destroy', $user)
        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
        </form>
    @endcan
</div>