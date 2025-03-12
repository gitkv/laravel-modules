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

    @if(count($items) > 0)
        <div class="items-list">
            @foreach($items as $item)
                <article class="item-card">
                    <h2 class="item-title">{{ $item->name }}</h2>
                    <p>{{ Str::limit($item->description, 100) }}</p>
                    <small><i>{{ $item->created_at->isoFormat('LL') }}</i></small>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $items->links('example::pagination.default') }}
        </div>

    @else
        <div class="empty-state">
            <p>No items found. Start by creating your first item!</p>
        </div>
    @endif
@endsection
