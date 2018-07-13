<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {

        return [
            'title' => 'required|min:2',
            'body' => 'required|min:3',
            'category_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'title.min' => '标题至少两个字符',
            'body.min' => '文章内容至少三个字符',
            'body.required' => '文章内容不能为空',
        ];
    }
}
