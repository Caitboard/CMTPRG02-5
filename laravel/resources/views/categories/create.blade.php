@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <div class="card-header">
            {{ isset($category) ? 'Edit category' : 'Create category' }}
{{--            If de categorie al defined is krijg je edit, else krijg je create--}}
        </div>
            <div class="card-body">
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
{{--                Controleert de validatie die we in de controller meegegeven hebben, bij een error krijgt de user dit te zien--}}
                <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                    @csrf
                    @if(isset($category))
                        @method('PUT')
                    @endif
{{--                    If de category al bepaald is gebruik je de method PUT, in plaats van POST--}}
                    <div class="form-group">
                        <label for="name">Category</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ isset($category) ? $category->name : ''  }}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                            {{ isset($category) ? 'Update category' : 'Add category' }}
                        </button>
                    </div>
                </form>
            </div>
    </div>
@endsection


