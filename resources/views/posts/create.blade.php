@extends('layouts.layout')

@section('content')

    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Создать пост</h2>
        <input type="text" name="title" required value="{{old('title') ?? ''}}">
        <textarea name="descr" rows="3" required value="{{old('descr') ?? ''}}"></textarea>
        <input type="file" name="img">
        <button>Создать пост</button>
        <a href="{{route('post.index')}}">На главную</a>
    </form>
@endsection
 