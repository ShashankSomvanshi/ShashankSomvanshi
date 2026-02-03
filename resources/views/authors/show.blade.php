@extends('layouts.app')

@section('title', 'View Author')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="display-5 fw-bold">
            <i class="bi bi-person-badge text-primary"></i> Author Details
        </h1>
        <div>
            <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('authors.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="bi bi-person-circle display-1 text-primary"></i>
                </div>
                <h3 class="card-title">{{ $author->name }}</h3>
                <p class="text-muted mb-3">
                    <i class="bi bi-envelope"></i> {{ $author->email }}
                </p>
                @if($author->birth_date)
                    <p class="mb-2">
                        <i class="bi bi-calendar3"></i>
                        <strong>Born:</strong> {{ $author->birth_date->format('F d, Y') }}
                    </p>
                    <p class="text-muted">
                        <small>({{ $author->birth_date->age }} years old)</small>
                    </p>
                @endif
                <hr>
                <div class="mt-3">
                    <span class="badge bg-info fs-6">
                        <i class="bi bi-book"></i> {{ $author->books->count() }} {{ Str::plural('Book', $author->books->count()) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 mb-4">
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-file-text"></i> Biography</h5>
            </div>
            <div class="card-body">
                @if($author->bio)
                    <p class="lead">{{ $author->bio }}</p>
                @else
                    <p class="text-muted fst-italic">No biography available.</p>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-journal-bookmark-fill"></i> Books by {{ $author->name }}</h5>
                <a href="{{ route('books.create') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Add Book
                </a>
            </div>
            <div class="card-body">
                @if($author->books->isEmpty())
                    <div class="text-center py-4">
                        <i class="bi bi-inbox display-4 text-muted"></i>
                        <p class="text-muted mt-3">No books yet by this author.</p>
                        <a href="{{ route('books.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Add First Book
                        </a>
                    </div>
                @else
                    <div class="list-group">
                        @foreach($author->books as $book)
                            <a href="{{ route('books.show', $book) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">
                                            <i class="bi bi-book"></i> {{ $book->title }}
                                        </h5>
                                        <p class="mb-1 text-muted">
                                            <small>
                                                <strong>ISBN:</strong> {{ $book->isbn }}
                                                @if($book->published_date)
                                                    | <strong>Published:</strong> {{ $book->published_date->format('Y') }}
                                                @endif
                                                @if($book->pages)
                                                    | <strong>Pages:</strong> {{ $book->pages }}
                                                @endif
                                            </small>
                                        </p>
                                    </div>
                                    <i class="bi bi-chevron-right"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
