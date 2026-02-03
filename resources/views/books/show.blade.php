@extends('layouts.app')

@section('title', 'View Book')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="display-5 fw-bold">
            <i class="bi bi-book text-primary"></i> Book Details
        </h1>
        <div>
            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="bi bi-book-fill display-1 text-primary"></i>
                </div>
                <h3 class="card-title mb-3">{{ $book->title }}</h3>

                <div class="mb-3">
                    <span class="badge bg-secondary fs-6">
                        <i class="bi bi-upc"></i> ISBN: {{ $book->isbn }}
                    </span>
                </div>

                <hr>

                <div class="text-start mt-4">
                    @if($book->author)
                    <p class="mb-2">
                        <i class="bi bi-person-fill text-primary"></i>
                        <strong>Author:</strong>
                        <a href="{{ route('authors.show', $book->author) }}" class="text-decoration-none">
                            {{ $book->author->name }}
                        </a>
                    </p>
                    @else
                    <p class="mb-2">
                        <i class="bi bi-person-fill text-primary"></i>
                        <strong>Author:</strong>
                        <span class="text-muted">No Author</span>
                    </p>
                    @endif

                    @if($book->published_date)
                        <p class="mb-2">
                            <i class="bi bi-calendar-check text-primary"></i>
                            <strong>Published:</strong>
                            {{ $book->published_date->format('F d, Y') }}
                        </p>
                    @endif

                    @if($book->pages)
                        <p class="mb-2">
                            <i class="bi bi-file-earmark-text text-primary"></i>
                            <strong>Pages:</strong>
                            {{ number_format($book->pages) }}
                        </p>
                    @endif

                    <p class="mb-2">
                        <i class="bi bi-clock text-primary"></i>
                        <strong>Added:</strong>
                        {{ $book->created_at->format('M d, Y') }}
                    </p>

                    @if($book->updated_at != $book->created_at)
                        <p class="mb-0">
                            <i class="bi bi-arrow-repeat text-primary"></i>
                            <strong>Updated:</strong>
                            {{ $book->updated_at->format('M d, Y') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-file-text"></i> Description</h5>
            </div>
            <div class="card-body">
                @if($book->description)
                    <p class="lead">{{ $book->description }}</p>
                @else
                    <p class="text-muted fst-italic">No description available for this book.</p>
                @endif
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="bi bi-info-circle"></i> Additional Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @if($book->author)
                    <div class="col-md-6 mb-3">
                        <div class="border-start border-primary border-4 ps-3">
                            <h6 class="text-muted mb-1">Author Email</h6>
                            <p class="mb-0">
                                <a href="mailto:{{ $book->author->email }}">
                                    {{ $book->author->email }}
                                </a>
                            </p>
                        </div>
                    </div>

                    @if($book->author->birth_date)
                    <div class="col-md-6 mb-3">
                        <div class="border-start border-info border-4 ps-3">
                            <h6 class="text-muted mb-1">Author Age</h6>
                            <p class="mb-0">{{ $book->author->birth_date->age }} years old</p>
                        </div>
                    </div>
                    @endif
                    @endif

                    <div class="col-md-6 mb-3">
                        <div class="border-start border-success border-4 ps-3">
                            <h6 class="text-muted mb-1">Book Status</h6>
                            <p class="mb-0">
                                <span class="badge bg-success">Active</span>
                            </p>
                        </div>
                    </div>

                    @if($book->author)
                    <div class="col-md-6 mb-3">
                        <div class="border-start border-warning border-4 ps-3">
                            <h6 class="text-muted mb-1">More by Author</h6>
                            <p class="mb-0">
                                <a href="{{ route('authors.show', $book->author) }}">
                                    View {{ $book->author->books->count() }} {{ Str::plural('book', $book->author->books->count()) }}
                                </a>
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex gap-2">
            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Are you sure you want to delete this book? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Delete Book
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
