@extends('layouts.app')


@section('content')
    @if (count($posts) === 0)
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <h1 style="color:red">{{ $error }}</h1>
                </div>

            </div>
            @elseif (count($posts) >= 1)
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <h1>{{ $posts->count()}}  found</h1>
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-md-10">
                                <table class="table">
                                    <tr>
                                        <th>Titel</th>
                                    </tr>
                                    @foreach($posts as $post) @if(Auth::user()->id == $post->user_id)
                                        <tr>
                                            <td><a href=" {{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>

                                        </tr>
                                    @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>


@endsection
