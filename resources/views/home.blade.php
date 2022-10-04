@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-4 text-end">
            @include('posts.inc.sort')            
        </div>
        <div class="row">
            @forelse($posts as $post)
                @include('posts.inc.item')
            @empty
                <h3>{{ __('No Posts found') }}</h3>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
