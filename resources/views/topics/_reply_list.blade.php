<div class="reply-list">
    @foreach($replies as $reply)
        <div class="media" name="reply{{ $reply->id }}" id="reply{{ $reply->id }}">
            <div class="avatar pull-left">
                <a href="{{ route('users.show', $reply->user_id) }}">
                    <img class="media-object img-thumbnail" src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}" style="width: 48px; height: 48px;">
                </a>
            </div>

            <div class="infos">
                <div class="media-heading">
                    <a href="{{ route('users.show', $reply->user_id) }}">
                        {{ $reply->user->name }}
                    </a>
                    <span> . </span>
                    <span class="meta" title="回复时间">{{ $reply->created_at->diffForHumans() }}</span>
                    
                    {{-- 回复删除按钮 --}}
                    <span class="meta pull-right">
                        <a href="#" title="删除回复">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </span>
                </div>
                <div class="reply-content">
                    {!! $reply->content !!}
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</div>