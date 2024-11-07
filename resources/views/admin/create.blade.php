@extends('layouts.app')

@section('content')
    <h1>Post a New Job</h1>

    <form action="{{ route('admin.jobs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Job Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" name="salary" id="salary" class="form-control" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Post Job</button>
    </form>
@endsection
