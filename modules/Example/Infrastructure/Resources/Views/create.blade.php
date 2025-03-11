@extends('example::layouts.app')

@section('title', 'Create New Item')

@section('content')
    <div class="form-container">
        <h1>Create New Item</h1>

        <form method="POST" action="{{ route('example.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Create</button>

            <a href="{{route('example.index')}}" class="btn">Back</a>
        </form>
    </div>
@endsection
