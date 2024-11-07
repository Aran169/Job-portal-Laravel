@extends('layouts.app')

@section('content')
    <h2>Apply for {{ $job->title }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('jobs.submitApplication', $job->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="phno">Phone Number</label>
            <input type="text" name="phno" id="phno" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="qualification">Qualification</label>
            <select name="qualification" id="qualification" class="form-control" required>
                <option value="10th">10th</option>
                <option value="12th">12th</option>
                <option value="UG">Undergraduate (UG)</option>
                <option value="PG">Postgraduate (PG)</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control-file" required>
        </div>
        
        
        
        <div class="form-group">
            <label for="resume">Resume</label>
            <input type="file" name="resume" id="resume" class="form-control-file">
        </div>
        
        <div class="form-group">
            <label for="location_preference">Location Preference (optional)</label>
            <input type="text" name="location_preference" id="location_preference" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit Application</button>
    </form>
@endsection
