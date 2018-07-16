<div class="media">
    <div class="avatar pull-left">
        <a href="{{ route('users.show', $notification->data['user_id']) }}">
            <img class="media-object img-thumbnail" src="{{ $notification->data['user_avatar'] }}" alt="{{ $notification->data['user_name'] }}" style="width: 48px; height: 48px;">
        </a>
    </div>
    
    <div class="infos">
        <div class="media-heading">
            <a href="{{ route('users.show', $notification->data['user_id']) }}">
                {{ $notification->data['user_name'] }}
            </a>

            <span class="meta pull-right" title="回复于">
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>
        <div class="reply-content">
            {!! $notification->data['reply_content'] !!}
        </div>
    </div>
</div>
<hr>