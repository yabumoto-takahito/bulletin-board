<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = \Request::query();

        if (isset($q['category_id'])) {
            $posts = Post::latest()->where('category_id', $q['category_id'])->paginate(5);
            $posts->load('category', 'user', 'tags');

            return view('posts.index', [
                'posts' => $posts,
                'category_id' => $q['category_id']
            ]);

        } elseif (isset($q['tag_name'])) {
            // dd($q['tag_name']);
            $posts = Post::latest()->where('content', 'LIKE', "%{$q['tag_name']}%")->paginate(5);
            $posts->load('category', 'user', 'tags');
            return view('posts.index', [
                'posts' => $posts,
                'tag_name' => $q['tag_name']
            ]);

        } else {
            $posts = Post::latest()->paginate(5);
            $posts->load('category', 'user', 'tags');

            return view('posts.index', [
                'posts' => $posts
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // アップロードに成功したか確認
        // isValidメソッドはファイルが存在しているかに付け加え,問題なくアップロードできたのかを確認することができる。
        if ($request->file('image')->isValid()) {
            $post = new Post;

            $post->title = $request->title;
            $post->content = $request->content;
            $post->user_id = $request->user_id;
            $post->category_id = $request->category_id;

            // // 保存：storage/app/public/image
            // // 読込：public/storage
            // // store()メソッドを使い、storage/app/public/imageに保存
            // $filename = $request->file('image')->store('public/image');

            // // ファイル名を取得
            // $post->image = basename($filename);

//////////////////////////////////////////////////////////////////////////////
            // getClientOriginalName()：アップロードするファイルのオリジナル名を取得
            $file_name = $request->file('image')->getClientOriginalName();

            // 画像の読み込み
            $img = \Image::make($request->file('image'));

            // 横幅を指定。高さは自動調整。
            $width = 500;
            $img->resize($width, null, function($constraint){
                $constraint->aspectRatio();
            });

            $img->save(public_path().'/images/'.$file_name);

            $post->image = $file_name;
//////////////////////////////////////////////////////////////////////////////

            //contentからtagを抽出
            //preg_match_all：繰り返し正規表現検索を行う。正規表現にマッチすると、そのマッチした文字列の後から検索が続行される。引数は、検索するパターンを表す文字列、入力文字列、マッチしたすべての内容を含む、flagsで指定した形式の多次元配列。
            preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠]+)/u', $request->content, $match);

            //$match[0]はパターン全体にマッチした文字列の配列、$match[1]は第1のキャプチャ用サブパターンにマッチした文字列の配列といった順番となる。
            // firstOrCreate()：DBにデータが存在する場合は取得し、存在しない場合はDBにデータを登録した上でインスタンスを取得する
            $tags = [];
            foreach ($match[1] as $tag) {
                $found = Tag::firstOrCreate(['tag_name' => $tag]);

                // array_push：一つ以上の要素を配列の最後に追加する
                array_push($tags, $found);
            }

            //$tagsからIDのみ抽出
            $tag_ids = [];
            foreach ($tags as $tag) {
                array_push($tag_ids, $tag['id']);
            }

            $post->save();

            // attachメソッドにタグIDの配列を渡すことによって、中間テーブルにタグを登録してくれる。
            $post->tags()->attach($tag_ids);
        }

            return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load('category', 'user', 'comments.user', 'likes');

        $userAuth = \Auth::user();

        $defaultCount = count($post->likes);
        $defaultLiked = $post->likes->where('user_id', $userAuth->id)->first();

        if (count($defaultLiked) == 0) {
            $defaultLiked == false;
        } else {
            $defaultLiked == true;
        }

        return view('posts.show',[
            'post' => $post,
            'userAuth' => $userAuth,
            'defaultLiked' => $defaultLiked,
            'defaultCount' => $defaultCount,
            ''
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'LIKE', "%$request->search%")
                 ->orWhere('content', 'LIKE', "%$request->search%")
                 ->paginate(5);

        $search_result = $request->search.'の検索結果'.$posts->total().'件';

        return view('posts.index', [
            'posts' => $posts,
            'search_result' => $search_result,
            'search_query' => $request->search
        ]);
    }
}
