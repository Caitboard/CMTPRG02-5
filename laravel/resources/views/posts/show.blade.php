@extends('layouts.app')
@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ $post->title }}
        </div>
        <div class="card-body">
                <div class="card-body">
                    <p class="card-text"><img src="{{ asset('/storage/'.$post->image) }}" alt="" style="width: 100%"></p>
                </div>
                <div class="card-header">Date</div>
                    <div class="card-body">
                        <p class="card-text">{{ $post->date }}</p>
                    </div>
                    <div class="card-header">Rating</div>
                    <div class="card-body">
                        <p class="card-text">{{ $post->rating }}</p>
                    </div>
                    <div class="card-header">Review</div>
                    <div class="card-body">
                        <p class="card-text">{{ $post->review }}</p>
                    </div>
                    <div class="card-header">Category</div>
                    <div class="card-body">
                        <p class="card-text">{{ $post->category->name }}</p>
                    </div>
            </div>
        </div>
    </div>
@endsection
