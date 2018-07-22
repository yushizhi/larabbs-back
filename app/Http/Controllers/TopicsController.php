<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Link;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, User $user, Link $link)
	{
		$topics = Topic::withOrder($request)->paginate(20);
		$active_users = $user->getActiveUsers();
		$links = $link->getAllCached();
		return view('topics.index', compact('topics', 'active_users', 'links'));
	}

    public function show(Request $request, Topic $topic)
    {
        if($topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }
        return view('topics.show', compact('topic'));
    }

	public function create()
	{
		$categories = Category::all();
	    return view('topics.create_and_edit', compact('categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
		$topic->fill($request->all());
		$topic->user_id = Auth::id();
		$topic->save();

		return redirect()->to($topic->link())->with('success', '成功创建话题！');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);

        $categories = Category::all();
		return view('topics.create_and_edit', compact('topic', 'categories'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->to($topic->link())->with('success', '更新成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '删除成功！');
	}

	//修改或新增 topic 支持图片上传
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        if($file = $request->upload_file) {
            $result = $uploader->save($file, 'topics', Auth::id(), 1024);

            if($result) {
                return [
                    'success' => true,
                    'msg' => "上传成功",
                    'file_path' => $result['path']
                ];
            }
        }

        return [
            'success' => false,
            'msg' => "上传失败",
            'file_path' => ''
        ];
    }
}