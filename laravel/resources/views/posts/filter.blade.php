@extends('layouts.app')
@section('content')
    <table class="table">
        <thead>
        <th>Title</th>
        <th>Category</th>
        <th></th>
        <th></th>
        </thead>
        <tbody>
        @foreach($posts as $post) @if(Auth::user() == $post->user) @if($category->id == $post->category->id)
            <tr>
                <td>
{{--                    {{ $category->name }}--}}
                    <a href="{{ route('posts.show', $post->id) }}" >{{ $post->title }}</a>

                </td>
                <td>
                    <a href="{{ route('categories.edit', $post->category->id) }}">{{ $post->category->name }}</a>
                </td>

            </tr>
        @endif
        @endif
        @endforeach

        </tbody>
    </table>
@endsection
