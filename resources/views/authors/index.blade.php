@extends('layouts.app')

@section('title', 'Authors - Book Management')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="display-5 fw-bold mb-0">
                <i class="bi bi-people-fill text-primary"></i> Authors
            </h1>
            <p class="text-muted mb-0">Manage your author database</p>
        </div>
        <a href="{{ route('authors.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle"></i> Add New Author
        </a>
    </div>
</div>

@if($authors->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-inbox display-1 text-muted"></i>
        <h3 class="mt-3 text-muted">No Authors Yet</h3>
        <p class="text-muted">Start by adding your first author!</p>
        <a href="{{ route('authors.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Author
        </a>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Birth Date</th>
                    <th>Books Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                <tr>
                    <td><span class="badge bg-secondary">#{{ $author->id }}</span></td>
                    <td>
                        <strong>{{ $author->name }}</strong>
                    </td>
                    <td>
                        <i class="bi bi-envelope"></i> {{ $author->email }}
                    </td>
                    <td>
                        @if($author->birth_date)
                            <i class="bi bi-calendar3"></i> {{ $author->birth_date->format('M d, Y') }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-info">
                            <i class="bi bi-book"></i> {{ $author->books_count }} {{ Str::plural('book', $author->books_count) }}
                        </span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('authors.show', $author) }}" class="btn btn-sm btn-info btn-action" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-warning btn-action" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this author? All associated books will also be deleted.');">
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
        {{ $authors->links('pagination::bootstrap-5') }}
    </div>
@endif
@endsection
