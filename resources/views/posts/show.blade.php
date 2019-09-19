@extends('layouts.app')

@section('content')
<div class="card-header">投稿の詳細</div>
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="card" style="margin-bottom: 20px;">
        <div class="card-body">
            <p class="card-title">
                <i class="fas fa-pen-alt"></i>&ensp;タイトル：{{ $post->title }}
            </p>
            <p class="card-title">
                <i class="fas fa-book"></i>&ensp;カテゴリー：{{ $post->category->category_name }}
            </p>
            <p class="card-title">
                <i class="fas fa-user"></i>&ensp;投稿者：{{ $post->user->name }}
            </p>
            <div class="card" style="height: 120px; margin-bottom: 20px;">
                <p class="card-text" style="padding: 10px 0 15px 15px;">
                    {{ $post->content }}
                </p>
            </div>
            <!-- <img src="{{ asset('storage/image/'.$post->image) }}"> -->
            <!-- <img src="{{ asset('public/images/'.$post->image) }}"> -->
            <img src="{{ asset('/images/'.$post->image) }}" class="img-fluid" alt="Responsive image">

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
        <i class="fas fa-pen-alt"></i>&ensp;コメントする
    </a>

    <div class="p-3" style="margin-top: 20px;">
        <h5 class="card-title">
            <i class="far fa-comments"></i>&ensp;コメント一覧
        </h5>
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
