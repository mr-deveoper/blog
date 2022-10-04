@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header"><h4 class="card-title">{{ $post->title }}</h4></div>
                    <div class="card-body">
                       <div class="card-text">
                            <p class="fs-3">{{ $post->description }}</p>
                            <p class="card-text"><strong>{{ __('Created By').': '.$post->user->name }}</strong></p>
                       </div>
                    </div>
                    <div class="card-footer">
                        <p>{{ $post->publication_date->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="text-center d-grid">
                    <a href="{{ route('home') }}" class="btn btn-success btn-block btn-full">{{ __('Back to Home') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
