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
            <h5 class="card-title">
                {{ $post->title }}
            </h5>
            <h5 class="card-title">
                カテゴリー：{{ $post->category->category_name }}
            </h5>
            <h5 class="card-title">
                投稿者：{{ $post->user->name }}
            </h5>
            <p class="card-text">
                {{ $post->content }}
            </p>
        </div>
    </div>
    @endforeach

</div>
@endsection
