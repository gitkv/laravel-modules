@extends('example::layouts.app')

@section('title', 'Example Module - Home')

@section('content')
    <header class="header">
        <h1>{{ $welcomeMessage }}</h1>
    </header>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('example.create') }}" class="btn btn-primary">Create new item</a>

    @if(count($examples) > 0)
        <div class="examples-list">
            @foreach($examples as $example)
                <article class="example-card">
                    <h2 class="example-title">{{ $example['name'] }}</h2>
                    <p>{{ $example['description'] }}</p>
                </article>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <p>No items found. Start by creating your first item!</p>
        </div>
    @endif
@endsection
