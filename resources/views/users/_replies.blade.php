@if (count($replies))

    <ul class="list-group">
        @foreach($replies as $reply)
            <li class="list-group-item">
                <a href="{{ $reply->topic->link(['#reply' . $reply->id]) }}">
                    {{ $reply->topic->title }}
                </a>

                <div class="reply-content" style="margin: 6px 0;">
                    {!! $reply->content !!}
                </div>

                <div class="meta">
                    <span class="glyphicon glyphicon-time" aria-hidden="true">回复于 {{ $reply->created_at->diffForHumans() }}</span>
                </div>
            </li>
         @endforeach
    </ul>

    {{-- 分页 --}}
    <div align="center">
        {!! $replies->appends(Request::except('page'))->links() !!}
    </div>

@else
    <div class="empty-block">
        暂无数据 ~_~
    </div>
@endif