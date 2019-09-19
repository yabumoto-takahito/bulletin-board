@extends('layouts.app')

@section('content')
<div class="card-header">{{ $user->name }}の投稿</div>
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @foreach($user->posts as $post)
    <div class="card">
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
        </div>
    </div>
    @endforeach

</div>
@endsection
