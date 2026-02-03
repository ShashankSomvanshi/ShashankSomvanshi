@extends('layouts.app')

@section('title', 'Add Book')

@section('content')
<div class="page-header">
    <h1 class="display-5 fw-bold">
        <i class="bi bi-book-fill text-primary"></i> Add New Book
    </h1>
    <p class="text-muted">Fill in the details below to add a new book</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="form-label fw-bold">
                            <i class="bi bi-bookmark"></i> Book Title *
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('title') is-invalid @enderror"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="Enter book title"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="author_id" class="form-label fw-bold">
                            <i class="bi bi-person"></i> Author *
                        </label>
                        <select class="form-select form-select-lg @error('author_id') is-invalid @enderror"
                                id="author_id"
                                name="author_id"
                                required>
                            <option value="">-- Select an Author --</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if($authors->isEmpty())
                            <small class="text-muted">
                                <i class="bi bi-info-circle"></i> No authors available.
                                <a href="{{ route('authors.create') }}">Create one first</a>
                            </small>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="isbn" class="form-label fw-bold">
                            <i class="bi bi-upc"></i> ISBN *
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('isbn') is-invalid @enderror"
                               id="isbn"
                               name="isbn"
                               value="{{ old('isbn') }}"
                               placeholder="978-3-16-148410-0 or 0-306-40615-2"
                               required>
                        <small class="form-text text-muted">
                            <i class="bi bi-info-circle"></i> Enter ISBN-10 or ISBN-13 format (e.g., 978-3-16-148410-0)
                        </small>
                        @error('isbn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="published_date" class="form-label fw-bold">
                                <i class="bi bi-calendar3"></i> Published Date
                            </label>
                            <input type="date"
                                   class="form-control form-control-lg @error('published_date') is-invalid @enderror"
                                   id="published_date"
                                   name="published_date"
                                   value="{{ old('published_date') }}">
                            @error('published_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="pages" class="form-label fw-bold">
                                <i class="bi bi-file-earmark-text"></i> Number of Pages
                            </label>
                            <input type="number"
                                   class="form-control form-control-lg @error('pages') is-invalid @enderror"
                                   id="pages"
                                   name="pages"
                                   value="{{ old('pages') }}"
                                   min="1"
                                   placeholder="e.g., 350">
                            @error('pages')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">
                            <i class="bi bi-file-text"></i> Description
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="5"
                                  placeholder="Write a brief description of the book...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('books.index') }}" class="btn btn-secondary btn-lg">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle"></i> Add Book
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
