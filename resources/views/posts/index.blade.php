@extends('layouts.app')

@section('content')
<div class="card-body" style="padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-title" style="padding-left: 20px">検索フォーム</h5>
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <form action="{{ route('posts.search') }}" method="get">
                            @csrf
                            <input type="text" class="form-control input-lg" placeholder="サイト内検索" name="search">
                            <span class="input-group-btn" style="position: relative; top: -37px; right: -166px;">
                                <button class="btn btn-info" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card-header">Board</div>

@if (isset($search_result))
    <h5 class="card-title" style="padding: 20px 0 0 30px; margin-bottom: 0;">{{ $search_result }}</h5>
@endif

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @foreach($posts as $post)
        <div class="card">
          <div class="card-body">
            <p class="card-title">タイトル：
                {{ $post->title }}
            </p>
            <p class="card-title">
                カテゴリー：
                <a href="{{ route('posts.index', ['category_id' => $post->category_id]) }}">
                    {{ $post->category->category_name }}
                </a>
            </p>
            <p class="card-title">
                タグ：
                @foreach ($post->tags as $tag)
                #<a href="{{ route('posts.index', ['tag_name' => '#'.$tag->tag_name]) }}">
                    {{ $tag->tag_name }}
                </a>,&ensp;
                @endforeach
            </p>
            <p class="card-title">
                投稿者：
                <a href="{{ route('users.show', $post->user_id) }}">{{ $post->user->name }}</a>
            </p>
            <hr>
            <p class="card-text">
                {{ $post->content }}
            </p>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細</a>
          </div>
        </div>
    @endforeach

    @if (isset($category_id))
        {{ $posts->appends(['category_id' => $category_id])->links() }}

    @elseif (isset($tag_name))
        {{ $posts->appends(['tag_name' => $tag_name])->links() }}

    @elseif (isset($search_query))
        {{ $posts->appends(['search' => $search_query])->links() }}

    @else
        {{ $posts->links() }}

    @endif

</div>

@endsection
