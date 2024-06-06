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
        <a href="{{route('post.destroy', ['id' => $post -> post_id])}}">Удалить пост</a>
    </div>
@endsection
 
