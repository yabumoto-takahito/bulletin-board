@extends('layouts.app')

@section('content')
<div class="card-header">{{ $user->name }}&ensp;のプロフィールページ</div>
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
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-edit"></i>&ensp;編集
            </a>
            <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-danger btn-sm btn-dell">
                <i class="far fa-trash-alt"></i>&ensp;削除
            </a>
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
