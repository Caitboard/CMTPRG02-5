@extends('layouts.app')

@section('content')


    <div class="card card-default">
        <div class="card-header">Users</div>
        <div class="card-body">
            @if($users->count() > 0)
            <table class="table">
                <thead>
                <th>Name</th>
                <th>Role</th>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            @if(!$user->isAdmin())
                                <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Make admin</button>
                                </form>
                            @else
                                <form action="{{ route('users.undo-admin', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-sm">Undo admin</button>
                                </form>
                            @endif
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            @else
                <h3 class="text-center">No users yet</h3>
            @endif

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
