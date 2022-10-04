@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Post') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p class="mb-0">{{ session('success') }}</p>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <p class="mb-0">{{ session('error') }}</p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('posts.store') }}">
                            @csrf

                            <div class="form-group row mb-2">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input id="title" class="form-control" name="title" value="{{ old('title') }}"
                                        required  >
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label for="publication_date" class="col-md-4 col-form-label text-md-right">{{ __('Publication Date') }}</label>
                                <div class="col-md-6">
                                    <input name="publication_date" id="publication_date" class="form-control" max="{{ date('Y-m-d H:i:s') }}" required
                                        type="datetime-local">
                                </div>
                            </div>

                            <div class="form-group row mt-4 text-center">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success mx-auto">{{ __('Create') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
