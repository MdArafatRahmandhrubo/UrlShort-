<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>URL Shortener</title>
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">URL Shortener</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">Create Short URL</div>
        <div class="card-body">
        <form method="post" action="{{ route('generate.shorten.link.store') }}">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="link" class="form-control" placeholder="Enter URL here" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">Generate</button>
                </div>
            </div>
            @error('link')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </form>

        </div>
    </div>

    @if(count($shortLinks) > 0)
    <div class="mt-4">
        <h3 class="mb-3">Your Short URLs</h3>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Short Link</th>
                    <th scope="col">Original Link</th>
                    <th scope="col">Clicks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shortLinks as $link)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="{{ route('shorten.link.redirect', $link->code) }}" target="_blank" class="short-link">{{ route('shorten.link.redirect', $link->code) }}</a></td>
                    <td>{{ $link->link }}</td>
                    <td>{{ $link->clicks ?? 0 }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info mt-4">No short URLs created yet.</div>
    @endif
</div>
@endsection




</body>
</html>
