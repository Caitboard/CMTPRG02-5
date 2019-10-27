@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success float-right">Add Movie</a>
    </div>
<div class="card card-default">
    <div class="card-header">Movies</div>
        <div class="card-body">
        <table class="table">
            <thead>
            <th>Image</th>
            <th>Title</th>
            <th></th>
            <th></th>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>
                        <img src="{{ asset('/storage/'.$post->image) }}" width="60px" height="60px" alt="">
                    </td>
                    <td>
                        {{ $post->title }}
                    </td>
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">Edit</a>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $post->id }})">Delete</button>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>

            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" method="POST" id="deletePostForm">
                        @method('DELETE')
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete movie</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this movie?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Go back</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        function handleDelete(id) {
            let form = document.getElementById('deletePostForm')
            form.action = '/posts/' + id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
