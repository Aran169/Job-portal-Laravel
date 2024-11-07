@extends('layouts.app')

@section('content')
<html>
<head>
   <style>
    .banner {
    
    position: relative;
    margin-left: 0;
    width: 100%;
    height: 100vh; /* Make the banner full height */
    background-image: url('{{ asset('homeimage.jpg') }}');
    background-size: cover; /* Ensure the image covers the entire banner area */
    background-position: center; /* Center the image */
    display: flex;
    justify-content: center; /* Center the content inside the banner */
    align-items: center; /* Align content vertically */
    text-align: center; /* Center the text horizontally */
}

.banner img {
    width: 100%;  /* Make the image cover the width of the screen */
    height: 100%; /* Make the image cover the full height */
    object-fit: cover; /* This makes sure the image fits perfectly */
}

.banner h1 {
    position: absolute;
    color: white; /* Text color for visibility */
    font-size: 3rem; /* Adjust text size */
    font-weight: bold;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Text shadow for better readability */
    bottom: 20px; /* Position the text at the bottom */
}

   </style>
</head>
<body>
    
    <div class="banner">
    <img src="{{ asset('homeimage.jpg') }}">
    <h1 >Scroll Down🔻🔻</h1>
    </div>
    <div>
    <h1 class="mb-4">Job Listings</h1>
    <form action="{{ route('jobs.search') }}" method="GET" class="d-flex w-50">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search jobs" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
</div>
    @if ($jobs->isEmpty())
        <p>No jobs available.</p>
    @endif
    <div class="row">
        @foreach($jobs as $job)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <p class="card-text">{{ Str::limit($job->description, 100) }}</p>
                        <p class="card-text"><strong>Location:</strong> {{ $job->location }}</p>
                        <p class="card-text"><strong>Salary:</strong> Rs. {{ number_format($job->salary, 2) }}</p>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
</body>
</html>
