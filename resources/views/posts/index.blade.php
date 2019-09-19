@extends('layouts.app')

@section('content')

<!-- タブ部分 -->
<ul id="myTab" class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a href="#home" id="home-tab" class="nav-link active" role="tab" data-toggle="tab" aria-controls="home" aria-selected="true"><i class="fas fa-mail-bulk"></i>&ensp;Posts</a>
  </li>
  <li class="nav-item">
    <a href="#profile" id="profile-tab" class="nav-link" role="tab" data-toggle="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-users"></i>&ensp;Users</a>
  </li>
</ul>


<!-- パネル部分 -->
<div id="myTabContent" class="tab-content mt-3">
    <div id="home" class="tab-pane active" role="tabpanel" aria-labelledby="home-tab">
        <div class="card-body" style="padding-bottom: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <form action="{{ route('posts.search') }}" method="get">
                                    @csrf
                                    <input type="text" class="form-control input-lg" placeholder="投稿から検索する" name="search">
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

        @if (isset($search_result))
            <h5 class="card-title" style="padding: 0 0 20px 30px; margin-bottom: 0;">{{ $search_result }}</h5>
        @endif

        <div class="card-body" style="padding-top: 0;">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @foreach($posts as $post)
                <div class="card" style="background-color: #f8f9fa;">
                  <div class="card-body">
                    <p class="card-title">
                        <i class="fas fa-pen-alt"></i>&ensp;タイトル：{{ $post->title }}
                    </p>
                    <p class="card-title">
                        <i class="fas fa-book"></i>&ensp;カテゴリー：
                        <a href="{{ route('posts.index', ['category_id' => $post->category_id]) }}">
                            {{ $post->category->category_name }}
                        </a>
                    </p>
                    <p class="card-title">
                        <i class="fas fa-tags"></i>&ensp;タグ：
                        @foreach ($post->tags as $tag)
                        #<a href="{{ route('posts.index', ['tag_name' => '#'.$tag->tag_name]) }}">
                            {{ $tag->tag_name }}
                        </a>&ensp;
                        @endforeach
                    </p>
                    <p class="card-title">
                        <i class="fas fa-user"></i>&ensp;投稿者：
                        <a href="{{ route('users.show', $post->user_id) }}">{{ $post->user->name }}</a>
                    </p>
                    <div class="card" style="height: 120px; margin-bottom: 20px;">
                        <p class="card-text" style="padding: 10px 0 15px 15px;">
                            {{ $post->content }}
                        </p>
                    </div>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary"><i class="far fa-check-square"></i>&ensp;詳細を見る</a>
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
    </div>
    <div id="profile" class="tab-pane" role="tabpanel" aria-labelledby="profile-tab">
        プロフィールの文章です。...
    </div>
</div>

<!-- @if (isset($search_result))
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

</div> -->

@endsection
