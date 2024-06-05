@extends('layouts.layout')

@section('content')

    <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2>Создать пост</h2>
        <input type="text" name="title" required>
        <textarea name="descr" rows="3" required></textarea>
        <input type="file" name="img">
        <button>Создать пост</button>
    </form>
@endsection
 