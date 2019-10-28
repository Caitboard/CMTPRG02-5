@extends('layouts.app')

@section('css')

@endsection
@section('scripts')

@endsection
@section('content')

    <div class="card card-default">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class="list-group-item text-danger">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header">
            {{ isset($post) ? 'Edit movie' : 'Add movie'}}
        </div>
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            @if(isset($post))
                @method('PUT')
            @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title " value="{{ isset($post) ?  $post->title : ' '}}">
                </div>

                <div class="form-group">
                    <label for="date">When did you watch this movie?</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{ isset($post) ?  $post->date : ' '}}">

                </div>

                <div class="form-group">
                    <label for="rating">Give your rating</label>
                    <input type="number" class="form-control" name="rating" id="rating" value="{{ isset($post) ?  $post->rating : ' '}}">
                </div>

                <div class="form-group">
                    <label for="review">Review</label>
                    <textarea name="review" id="review" cols="5" rows="5" class="form-control" >{{ isset($post) ?  $post->review : ' '}}</textarea>
                </div>

                @if(isset($post))
                    <img src="{{ asset('/storage/'.$post->image) }}" alt="" style="width: 100%">
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>

                <div class="form-group">
                    <label for="category" class="for">Category</label>
                    <select name="category" id="category" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                                @if(isset($post))
                                    @if($category->id == $post->category_id)
                                        selected
                                    @endif
                                @endif
                            >
                            {{ $category->name }}
                        </option>
                    @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{ isset($post) ? 'Update' : 'Add movie' }}
                    </button>
                </div>


            </form>
        </div>
    </div>
@endsection

<script>
    flatpickr("#date")
</script>
