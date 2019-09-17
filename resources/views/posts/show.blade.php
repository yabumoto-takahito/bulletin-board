@extends('layouts.app')

@section('content')
<div class="card-header">Board</div>
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <p class="card-title">
                タイトル：{{ $post->title }}
            </p>
            <p class="card-title">
                カテゴリー：{{ $post->category->category_name }}
            </p>
            <p class="card-title">
                投稿者：{{ $post->user->name }}
            </p>
            <hr>
            <p class="card-text">
                {{ $post->content }}
            </p>
            <!-- <img src="{{ asset('storage/image/'.$post->image) }}"> -->
            <!-- <img src="{{ asset('public/images/'.$post->image) }}"> -->
            <img src="{{ asset('/images/'.$post->image) }}">
            </p>
        </div>
    </div>

    <like
    :post-id="{{ json_encode($post->id) }}"
    :user-id="{{ json_encode($userAuth->id) }}"
    :default-liked="{{ json_encode($defaultLiked) }}"
    :default-count="{{ json_encode($defaultCount) }}"
    style="margin-top: 10px;"
    >
    </like>
    <a href="{{ route('comments.create', ['post_id' => $post->id]) }}" class="btn btn-primary" style="margin-top: 10px;">
        コメントする
    </a>

    <div class="p-3" style="margin-top: 20px;">
        <h5 class="card-title">コメント一覧</h5>
        @foreach($post->comments as $comment)
        <div class="card">
            <div class="card-body">
                <p class="card-text">
                    {{ $comment->comment }}
                </p>
                <p class="card-text">
                    投稿者：<a href="{{ route('users.show', $comment->user->id) }}">{{ $comment->user->name }}</a>
                </p>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
