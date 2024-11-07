@extends('layouts.app')

@section('content')
    <h1>{{ $job->title }}</h1>
    <p><strong>Description:</strong> {{ $job->description }}</p>
    <p><strong>Location:</strong> {{ $job->location }}</p>
    <p><strong>Salary:</strong> Rs.{{ number_format($job->salary, 2) }}</p>

    @auth
        <form action="{{ route('jobs.apply', $job->id) }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-success">Apply for this Job</button>
        </form>
        @if($hasApplied)
    <p>You have already applied to this job.</p>

@endif


    @else
        <p class="alert alert-warning">Please <a href="{{ route('login') }}">login</a> to apply for this job.</p>
    @endauth
@endsection
