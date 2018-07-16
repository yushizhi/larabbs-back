<?php

namespace App\Observers;

use Auth;
use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function created(Reply $reply)
    {
        $reply->topic->increment('reply_count', 1);

        //通知作者话题被回复了
        if($reply->topic->user_id != Auth::id()){
            $reply->topic->user->notify(new TopicReplied($reply));
            $reply->topic->user->increment('notification_count');
        }

    }
}