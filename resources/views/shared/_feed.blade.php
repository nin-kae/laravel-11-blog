@if ($feedItems->isNotEmpty())
    <ul class="list-unstyled">
        @foreach ($feedItems as $status)
            @include('statuses._status',  ['user' => $status->user])
        @endforeach
    </ul>
    <div class="mt-5">
        {!! $feedItems->links() !!}
    </div>
@else
    <p>没有数据！</p>
@endif
