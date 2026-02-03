<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index(): View
    {
        $authors = Author::withCount('books')->latest()->paginate(10);
        return view('authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new author.
     */
    public function create(): View
    {
        return view('authors.create');
    }

    /**
     * Store a newly created author in storage.
     */
    public function store(StoreAuthorRequest $request): RedirectResponse
    {
        Author::create($request->validated());

        return redirect()->route('authors.index')
            ->with('success', 'Author created successfully!');
    }

    /**
     * Display the specified author.
     */
    public function show(Author $author): View
    {
        $author->load('books');
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified author.
     */
    public function edit(Author $author): View
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified author in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author): RedirectResponse
    {
        $author->update($request->validated());

        return redirect()->route('authors.index')
            ->with('success', 'Author updated successfully!');
    }

    /**
     * Remove the specified author from storage.
     */
    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();

        return redirect()->route('authors.index')
            ->with('success', 'Author deleted successfully!');
    }
}
