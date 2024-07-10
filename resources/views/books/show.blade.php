@php use Illuminate\Support\Facades\Storage;use Illuminate\Support\Facades\Vite; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card mb-3 col-8">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ Storage::url($book->cover) }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $book->title }}<span class="text-primary">({{ number_format($book->rating, 2) ?? 'not rated yet.' }})</span>
                        </h5>
                        <p class="card-text">
                            <small class="text-body-secondary">
                                Published At {{ $book->published_at->format('M j, Y') }}
                            </small>
                        </p>

                        @auth
                            <div class="col-6">
                                <form action="{{ route('books.rate', $book) }}" method="POST">
                                    @csrf

                                    <div>
                                        <select class="form-select @error('rating') is-invalid @enderror" name="rating">
                                            <option selected hidden>{{ __('Rate this book') }}</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                            <option value="4">Four</option>
                                            <option value="5">Five</option>
                                        </select>

                                        @error('rating')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mt-2">
                                        <button class="btn btn-primary" @disabled($book->isRatedBy(auth()->user()))>
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        @forelse($book->comments as $comment)
            <div class="card mb-2">
                <div class="card-header">
                    {{ $comment->created_at->diffForHumans() }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->user->name }}</h5>
                    <p class="card-text">
                        {{ $comment->body }}
                    </p>
                </div>
            </div>
        @empty
            No comments yet.
        @endforelse

        @auth
            <form action="{{ route('books.comment', $book) }}" class="mt-2" method="POST">
                @csrf

                <div class="mb-3">
                    <textarea
                        class="form-control @error('body') is-invalid @enderror"
                        id="body"
                        rows="3"
                        placeholder="Have something to say?"
                        name="body"
                    ></textarea>

                    @error('body')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Publish</button>
            </form>
        @endauth

        <div id="suggestions"></div>
    </div>
@endsection
@push('scripts')
    <script>
        const updateBookSuggestions = async function () {
            const response = await fetch(`/books/suggestions`);

            document.querySelector('#suggestions').innerHTML = await response.text();
        };

        updateBookSuggestions();

        setInterval(updateBookSuggestions, 10000);
    </script>
@endpush
