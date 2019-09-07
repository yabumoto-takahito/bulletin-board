@extends('layouts.app')

@section('content')
<div class="card-header">comment</div>
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <!-- バリデーションエラー表示 -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action=" {{ route('comments.store') }} " method="post">
                @csrf
              <!-- 本文 -->
              <div class="form-group">
                <label for="exampleInputTitle1">content</label>
                <textarea type="text" rows="5" class="form-control" id="exampleInputContent" placeholder="本文" name="comment"></textarea>
              </div>
              <!-- ユーザーID追加 -->
              <input type="hidden" name="user_id" value="{{ Auth::id() }}">
              <!-- 投稿のID追加 -->
              <input type="hidden" name="post_id" value="{{ $post_id }}">
              <!-- 送信 -->
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>
@endsection
