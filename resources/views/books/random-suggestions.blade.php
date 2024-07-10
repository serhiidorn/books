<div class="row row-cols-1 mt-5 justify-content-center gap-2">
    @foreach($randomBooks as $book)
        <div class="col col-sm-5 col-md-5 col-lg-2">
            <div class="card h-100">
                    <img src="{{ Storage::url($book->cover) }}" class="card-img-top" alt="book\'s cover">
                <div class="card-body align-content-end">
                    <h5 class="card-title text-center">{{ $book->title }}</h5>
                </div>
            </div>
        </div>
    @endforeach
</div>