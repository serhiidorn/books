@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Vite;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row align-items-center">
            <div class="mt-3">
                <form class="d-flex col col-sm-10 col-md-4" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>

            <div class="mt-3">
                <button id="updateBookList" class="d-inline btn btn-primary text-nowrap">
                    {{ __('Update the list') }}
                </button>
            </div>

            @auth
                <div class="mt-3">
                    <a href="{{ route('books.create') }}" class="d-inline btn btn-success text-nowrap">
                        {{ __('Create a new book') }}
                    </a>
                </div>
            @endauth
        </div>

        <table class="table table-responsive mt-2" id="booksTable">
            <thead>
                <tr>
                    <th>
                        {{ __('Cover') }}
                    </th>
                   <x-sortable-table-header label="{{ __('title') }}"/>
                    <th>
                        {{ __('Author') }}
                    </th>
                    <th class="text-nowrap">
                        {{ __('Published at') }}
                    </th>
                    <x-sortable-table-header label="{{ __('rating') }}"/>
                </tr>
            </thead>
            <tbody>
                @include('books.list')
            </tbody>
        </table>

        <div class="mt-3">
            {{ $books->links() }}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const updateBookListListener = async function () {
            const response = await fetch(`/books/${window.location.search}`, {headers: {"Accept": "application/json"}});

            document.querySelector('#booksTable > tbody').innerHTML = await response.text();
        };

        document.getElementById('updateBookList').addEventListener('click', updateBookListListener);

        setInterval(updateBookListListener, 60000);
    </script>
@endpush