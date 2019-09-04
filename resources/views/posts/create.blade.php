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
            <form>
              <div class="form-group">
                <label for="exampleInputTitle1">title</label>
                <input type="text" class="form-control" id="exampleInputTitle1" placeholder="タイトル">
              </div>
              <div class="form-group">
                <label for="exampleInput1">category</label>
                <select class="form-control" id="exampleInputCategory" placeholder="カテゴリー" name="category_id">
                    <option selected="">選択する</option>
                    <option value="1">life</option>
                    <option value="2">programming</option>
                    <option value="3">love</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputTitle1">content</label>
                <textarea type="text" rows="5" class="form-control" id="exampleInputContent" placeholder="本文"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">送信する</button>
            </form>
        </div>
    </div>

</div>
@endsection
