@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-body">
                <h2 class="text-center">
                    <i class="glyphicon glyphicon-pencil"></i>
                    @if (isset($topic))
                        编辑话题
                    @else
                        新建话题
                    @endif
                </h2>

                <hr>

                @include('common.error')

                @if (isset($topic))
                <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ?? '') }}" placeholder="请填写标题" required>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category_id" required>
                            <option value="" hidden disabled {{ isset($topic->id) ? '' : 'selected' }}>请选择分类</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ isset($topic) && $topic->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="editor" rows="3" placeholder="请填入至少三个字符的内容。" required >{{ old('body', $topic->body ?? '') }}</textarea>
                    </div>
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                            保存
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/simditor.css') }}" type="text/css">
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            var editor = new Simditor({
                textarea: $('#editor'),
                upload: {
                    url: '{{ route('topics.upload_image') }}',
                    params: { _token: '{{ csrf_token() }}'},
                    file_key: 'upload_file',
                    connetctionCount: 3,
                    leaveConfirm: '文件上传中，关闭此页面将取消上传。'
                },
                pastImage: true,
            });
        });
    </script>
@endsection