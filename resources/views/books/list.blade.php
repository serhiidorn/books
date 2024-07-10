@forelse($books as $book)
    <tr>
        <td>
            <img src="{{ Storage::url($book->cover) }}" alt="book\'s cover" width="75">
        </td>
        <td class="align-middle">
            <a href="{{ route('books.show', $book) }}">
                {{ $book->title }}
            </a>
        </td>
        <td class="align-middle">{{ $book->author }}</td>
        <td class="align-middle">{{ $book->published_at->format('M d, Y') }}</td>
        <td class="align-middle">{{ number_format($book->rating, 2) }}</td>
    </tr>
@empty
    <tr>
        <th colspan="5">
            {{ __('No books yet.') }}
        </th>
    </tr>
@endforelse