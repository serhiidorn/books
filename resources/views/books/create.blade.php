@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header h3 text-center">
                        {{ __('Add a new book') }}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('books.store') }}" enctype="multipart/form-data" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="author" class="col-md-4 col-form-label text-md-end">{{ __('Author') }}</label>

                                <div class="col-md-6">
                                    <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" value="{{ old('author') }}" autocomplete="author" autofocus>

                                    @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="published_at" class="col-md-4 col-form-label text-md-end">{{ __('Published at') }}</label>

                                <div class="col-md-6">
                                    <input id="published_at" type="date" class="form-control @error('published_at') is-invalid @enderror" name="published_at" value="{{ old('published_at') }}" autocomplete="published_at" autofocus>

                                    @error('published_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cover" class="col-md-4 col-form-label text-md-end">{{ __('Cover') }}</label>

                                <div class="col-md-6">
                                    <input class="form-control @error('cover') is-invalid @enderror" type="file" id="cover" name="cover">
                                    <small class="text-muted">
                                        {{ __('File must be less then 5mb') }}
                                    </small>

                                    @error('cover')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary col-md-4">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
