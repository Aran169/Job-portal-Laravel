@extends('layouts.app')

@section('content')
    <h1>Edit Job: {{ $job->title }}</h1>

    <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $job->title }}" required>
        </div>
        <div class="form-group">
            <label for="description">Job Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $job->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" value="{{ $job->location }}" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" name="salary" id="salary" class="form-control" step="0.01" value="{{ $job->salary }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Job</button>
    </form>
@endsection
