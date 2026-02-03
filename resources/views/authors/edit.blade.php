@extends('layouts.app')

@section('title', 'Edit Author')

@section('content')
<div class="page-header">
    <h1 class="display-5 fw-bold">
        <i class="bi bi-pencil-square text-primary"></i> Edit Author
    </h1>
    <p class="text-muted">Update author information</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('authors.update', $author) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">
                            <i class="bi bi-person"></i> Full Name *
                        </label>
                        <input type="text"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               id="name"
                               name="name"
                               value="{{ old('name', $author->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-bold">
                            <i class="bi bi-envelope"></i> Email Address *
                        </label>
                        <input type="email"
                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email', $author->email) }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="birth_date" class="form-label fw-bold">
                            <i class="bi bi-calendar3"></i> Birth Date
                        </label>
                        <input type="date"
                               class="form-control form-control-lg @error('birth_date') is-invalid @enderror"
                               id="birth_date"
                               name="birth_date"
                               value="{{ old('birth_date', $author->birth_date?->format('Y-m-d')) }}">
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="bio" class="form-label fw-bold">
                            <i class="bi bi-file-text"></i> Biography
                        </label>
                        <textarea class="form-control @error('bio') is-invalid @enderror"
                                  id="bio"
                                  name="bio"
                                  rows="5">{{ old('bio', $author->bio) }}</textarea>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('authors.index') }}" class="btn btn-secondary btn-lg">
                            <i class="bi bi-x-circle"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-check-circle"></i> Update Author
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
