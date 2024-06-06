@extends('layouts.layout')

@section('content')

    <form action="{{route('post.update', ['id' => $post -> post_id])}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <h2>Редактировать пост</h2>
        <input name="title" type="text" required value="{{$post->title}}">
        <textarea name="descr" rows="3" required>{{$post->descr}}</textarea>
        <input type="file" name="img">
        <button>Редактировать пост</button>
    </form>
@endsection
 