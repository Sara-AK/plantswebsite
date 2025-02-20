@extends('layouts.admin')

@section('title', 'Manage Articles')

@section('content')
    <section class="content">
        <div class="section-header text-center">
            <h5 class="wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".2s">
                ALL ARTICLES
            </h5>
            <h2 class="wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".4s">Edit and Add Articles</h2>
        </div>

        <div class="container-fluid">
            <!-- Add Article Form -->
            <div class="card shadow-sm rounded mb-4">
                <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
                    <h3 class="card-title text-white">Add Article</h3>
                    <button type="button" class="btn btn-tool text-white" data-bs-toggle="collapse" data-bs-target="#addArticleForm">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div id="addArticleForm" class="collapse p-3">
                    <div class="card-body">
                        <form action="{{ route('admin.articles.store') }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label>Title</label>
                                    <input type="text" class="form-control rounded" name="title" placeholder="Enter article title" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Author</label>
                                    <select name="author_id" class="form-control rounded select2" required>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label>Content</label>
                                <textarea class="form-control rounded" name="content" rows="5" placeholder="Enter article content" required></textarea>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success rounded">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Articles List -->
            <div class="card shadow-sm rounded">
                <div class="card-header bg-dark-green d-flex justify-content-between align-items-center rounded">
                    <h3 class="card-title text-white">All Articles</h3>
                    <button type="button" class="btn btn-tool text-white" data-bs-toggle="collapse" data-bs-target="#articlesTable">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover table-dark-green rounded">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->author->name }}</td>
                                    <td>{{ $article->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning btn-sm rounded">Edit</a>
                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection
