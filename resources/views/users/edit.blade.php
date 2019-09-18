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
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">編集</a>
            <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger btn-sm btn-dell">削除</a>
        </div>
    </div>
    @endforeach

</div>
<script>
$(function(){
    $(".btn-dell").click(function(){
        if(confirm("本当に削除しますか？")){
        //そのままsubmit（削除）
        } else {
            //cancel
            return false;
        }
    });
});
</script>
@endsection
