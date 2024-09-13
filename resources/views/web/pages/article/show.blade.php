@extends('layouts.app')
@section('title', 'Blog')

@section('content')
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h1 class="display-5 mb-4">{{ $article->title }}</h1>
                <img src="{{ asset($article->thumbnail) }}" style="width: 700px" alt="thumbnail">
            </div>
            <p>
                {!! $article->description !!}
            </p>
        </div>
    </div>
@endsection