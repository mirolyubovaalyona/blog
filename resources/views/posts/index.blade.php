@extends('layouts.layout')

@section('content')

    <form action="{{route('post.index')}}">
    <input name="search">
    <button>Поиск</button>
    </form>

    @if (isset($_GET['search']))
        @if (count($posts)>0)
            <h2>Результаты поиска по запросу <?=$_GET['search']?> </h2>
            <p>Всего найденно {{count($posts)}} постов</p>
        @else
            <h1>По вашему запросу ничего не найденно</h1>
            <a href="{{route('post.index')}}"> Показать все посты </a>
        @endif
    @endif

    @foreach ($posts as $post)
        <div>
            <h3>{{$post->short_title}}</h3>
            <div>{{$post->descr}}</div>
            <img src="{{$post->img ??  asset('img/no-image.png') }}">
            <div>{{$post->name}}</div>
            <a href="{{route('post.show', ['id' => $post -> post_id])}}"> Посмотреть пост </a>
        </div>
    @endforeach

    @if (!isset($_GET['search']))
        {{ $posts ->links() }}
    @endif
    
@endsection
 
