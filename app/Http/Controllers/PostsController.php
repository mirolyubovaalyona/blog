<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $posts  = Post::join('users', 'author_id', '=', 'users.id')
                ->where('title',  'like', '%' . $request->search.'%'  )
                ->orWhere('descr', 'like', '%' . $request->search. '%'  )
                ->orWhere('name', 'like', '%' . $request->search.'%'  )
                ->orderBy('posts.created_at')
                ->paginate(4);
            return view('posts.index', compact('posts'));
        }
        #обьединяем две таблицы чтобы выводить имя автора, сортируем по дате создания поста
        #пагинация по 4 поста на странице
        $posts  = Post::join('users', 'author_id', '=', 'users.id')
                ->orderBy('posts.created_at')
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
    public function store(Request $request)
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
