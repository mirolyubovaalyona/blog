@extends('layouts.layout')

@section('content')
    <div>
        <h3>{{$post->title}}</h3>
        <div>{{$post->descr}}</div>
        <img src="{{$post->img ??  asset('img/no-image.png') }}">
        <div>{{$post->name}}</div>
        <div>{{$post->created_at->diffForHumans()}}</div>
        <a href="{{route('post.index')}}">На главную</a>
        <a href="{{route('post.edit', ['id' => $post -> post_id])}}">Редактировать</a>
        <form action="{{route('post.destroy', ['id' => $post -> post_id])}}" method="POST" 
            onsubmit="if (confirm('Точно удалть пост?')) {return true} else {return false}">
            @csrf
            @method('DELETE')
            <input type="submit" value="Удалить пост">
        </form>
    </div>
@endsection
 
