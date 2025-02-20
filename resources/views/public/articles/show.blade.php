@extends('layouts.app')
@section('title', 'Article Page')
@section('content')

@section('content')
<div class="container py-5">
    <h2>{{ $article->title }}</h2>
    <p><strong>By: {{ $article->author->name }}</strong></p>
    <hr>
    <p>{{ $article->content }}</p>
    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Back to Articles</a>
</div>
@endsection
