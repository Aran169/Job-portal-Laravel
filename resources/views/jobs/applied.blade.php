@extends('layouts.app')

@section('content')
    <h3>My Applied Jobs</h3>

    @if($appliedJobs->isEmpty())
        <p>No jobs applied yet.</p>
    @else
        <div class="row">
            @foreach($appliedJobs as $appliedJob)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $appliedJob->job->title }}</h5>
                            <p class="card-text">{{ Str::limit($appliedJob->job->description, 100) }}</p>
                            <p class="card-text"><strong>Location:</strong> {{ $appliedJob->job->location }}</p>
                            <p class="card-text"><strong>Salary:</strong> Rs. {{ number_format($appliedJob->job->salary, 2) }}</p>
                            <a href="{{ route('jobs.show', $appliedJob->job->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
