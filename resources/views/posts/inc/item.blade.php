<div class="col-md-4 d-flex  align-items-stretch" style="">
    <div class="card text-left mb-4 w-100">
        <div class="card-body">
            <h3 class="card-title pb-3"><a href="{{ route('posts.show', $post->id) }}" class="text-success text-decoration-none">{{ $post->title }}</a></h3>
            <blockquote class="blockquote mb-0">
                <p>{{ $post->excerpt() }}</p>
                <footer class="blockquote-footer my-3">{{ $post->user->name }}</footer>
            </blockquote>

            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">{{ __('Read More') }}</a>
        </div>
        <div class="card-footer text-muted">
            {{ $post->publication_date->diffForHumans() }}
        </div>
    </div>
</div>