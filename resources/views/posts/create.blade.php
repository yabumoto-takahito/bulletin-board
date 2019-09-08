@extends('layouts.app')

@section('content')
<div class="card-header">Board</div>
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
            <form action=" {{ route('posts.store') }} " method="post" enctype="multipart/form-data">
                @csrf
                <!-- タイトル入力欄 -->
              <div class="form-group">
                <label for="exampleInputTitle1">title</label>
                <input type="text" class="form-control" id="exampleInputTitle1" placeholder="タイトル" name="title">
              </div>
              <!-- 画像選択欄 -->
                <div class="form-group">
                  <label for="File">画像の選択</label>
                  <input type="file" class="form-control-file" id="File" name="image">
                </div>
              <!-- カテゴリー入力欄 -->
              <div class="form-group">
                <label for="exampleInput1">category</label>
                <select class="form-control" id="exampleInputCategory" placeholder="カテゴリー" name="category_id">
                    <option selected="">選択する</option>
                    <option value="1">life</option>
                    <option value="2">programming</option>
                    <option value="3">love</option>
                </select>
              </div>
              <!-- 本文 -->
              <div class="form-group">
                <label for="exampleInputTitle1">content</label>
                <textarea type="text" rows="5" class="form-control" id="exampleInputContent" placeholder="本文" name="content"></textarea>
              </div>
              <!-- ユーザーID追加 -->
              <input type="hidden" name="user_id" value="{{ Auth::id() }}">
              <!-- 送信 -->
              <button type="submit" class="btn btn-primary">送信する</button>
            </form>
        </div>
    </div>

</div>
@endsection
