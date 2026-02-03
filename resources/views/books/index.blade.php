@extends('layouts.app')

@section('title', 'Books - Book Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="display-5 fw-bold mb-0">
                <i class="bi bi-journal-bookmark-fill text-primary"></i> Books
            </h1>
            <p class="text-muted mb-0">Browse and manage your book collection</p>
        </div>
        <a href="{{ route('books.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle"></i> Add New Book
        </a>
    </div>
</div>

@if($books->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-inbox display-1 text-muted"></i>
        <h3 class="mt-3 text-muted">No Books Yet</h3>
        <p class="text-muted">Start by adding your first book!</p>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Book
        </a>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Published</th>
                    <th>Pages</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td><span class="badge bg-secondary">#{{ $book->id }}</span></td>
                    <td>
                        <strong>{{ $book->title }}</strong>
                    </td>
                    <td>
                        @if($book->author)
                            <a href="{{ route('authors.show', $book->author) }}" class="text-decoration-none">
                                <i class="bi bi-person"></i> {{ $book->author->name }}
                            </a>
                        @else
                            <span class="text-muted">No Author</span>
                        @endif
                    </td>
                    <td>
                        <code>{{ $book->isbn }}</code>
                    </td>
                    <td>
                        @if($book->published_date)
                            <i class="bi bi-calendar3"></i> {{ $book->published_date->format('Y') }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        @if($book->pages)
                            <span class="badge bg-info">{{ $book->pages }} pages</span>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info btn-action" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger btn-action" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
