<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema; 
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $postColumns = Schema::getColumnListing('posts');
        $userColumns = Schema::getColumnListing('users');
        $postColumns = array_diff($postColumns, ['id']);
        $selectColumns = array_merge( ['posts.id as post_id'], array_map(function($col) {
                return 'posts.' . $col;
            }, $postColumns), array_map(function($col) {
                return 'users.' . $col;
            }, $userColumns)
        );

        if ($request->search) {
            
            $posts  = Post::join('users', 'posts.author_id', '=', 'users.id')
                ->select($selectColumns)
                ->where('title',  'like', '%' . $request->search.'%'  )
                ->orWhere('descr', 'like', '%' . $request->search. '%'  )
                ->orWhere('name', 'like', '%' . $request->search.'%'  )
                ->orderByDesc('posts.created_at')
                ->paginate(4);
            return view('posts.index', compact('posts'));
        }
        #обьединяем две таблицы чтобы выводить имя автора, сортируем по дате создания поста
        #пагинация по 4 поста на странице
        $posts  = Post::join('users', 'posts.author_id', '=', 'users.id')
                ->select($selectColumns)
                ->orderByDesc('posts.created_at')
                ->paginate(4);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post -> title = $request -> title;
        $post -> short_title = strlen($post -> title) > 30 ? mb_substr($post -> title, 0, 30) . '...' : $post -> title;
        $post -> descr = $request -> descr;
        $post -> author_id = rand(1, 10);

        if ($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post -> img =  $url;
        } 

        $post->save();
        return redirect() ->route('post.index')->with('success', 'Пост успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $postColumns = Schema::getColumnListing('posts');
        $userColumns = Schema::getColumnListing('users');
        $postColumns = array_diff($postColumns, ['id']);
        $userColumns = array_diff($userColumns, ['created_at']);
        $selectColumns = array_merge( ['posts.id as post_id'], array_map(function($col) {
                return 'posts.' . $col;
            }, $postColumns), array_map(function($col) {
                return 'users.' . $col;
            }, $userColumns)
        );

        $post  = Post::join('users', 'posts.author_id', '=', 'users.id')
                ->select($selectColumns)
                ->find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postColumns = Schema::getColumnListing('posts');
        $userColumns = Schema::getColumnListing('users');
        $postColumns = array_diff($postColumns, ['id']);
        $selectColumns = array_merge( ['posts.id as post_id'], array_map(function($col) {
                return 'posts.' . $col;
            }, $postColumns), array_map(function($col) {
                return 'users.' . $col;
            }, $userColumns)
        );
        $post  = Post::join('users', 'posts.author_id', '=', 'users.id')
            ->select($selectColumns)
            ->find($id);
       
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $post  = Post::find($id);
        $post -> title = $request ->title;
        $post -> short_title = strlen($post -> title) > 30 ? mb_substr($post -> title, 0, 30) . '...' : $post -> title;
        $post -> descr = $request -> descr;
        if ($request->file('img')) {
            $path = Storage::putFile('public', $request->file('img'));
            $url = Storage::url($path);
            $post -> img =  $url;
        } 

        $post->update();
        $id = $post->id;
        return redirect() ->route('post.show', compact('id'))->with('success', 'Пост успешно отредактирован');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post  = Post::find($id);
        $post -> delete();
        return redirect() ->route('post.index')->with('success', 'Пост успешно удалён');
    }
}
