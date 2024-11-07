@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Admin Dashboard</h1>
    <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary mb-3">Post New Job</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Location</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->location }}</td>
                    <td>{{ $job->salary}}</td>
                    <td>
                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this job?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
