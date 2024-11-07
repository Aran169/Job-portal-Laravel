<?php

namespace App\Http\Controllers;

use App\Models\Job; // Ensure to import your Job model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show the admin login form
    public function showAdminLoginForm()
    {
        return view('admin.login'); // Assuming you want to use the existing auth.login view for admin login
    }

    // Handle the admin login authentication
    public function authenticate(Request $request)
    {
        // Define the default admin credentials
        $defaultEmail = 'aran9003@gmail.com'; // Default admin email
        $defaultPassword = '123456789'; // Default admin password

        // Validate the request input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8', // Adjust as needed
        ]);

        // Check if the input matches the default credentials
        if ($request->email === $defaultEmail && $request->password === $defaultPassword) {
            // Log the admin in
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        }
        else{
            return "Invalid credentials...";
        }
    }

    // Show the admin dashboard
    public function showDashboard()
    {
        $jobs = Job::all(); // Get all jobs from the database
        return view('admin.index', compact('jobs')); // Use admin.index for the dashboard view
    }

    // Show the create job form
    public function create()
    {
        return view('admin.create'); // Pointing to the correct view for job creation
    }

    public function store(Request $request)
{
    // Validate and store the job data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
        'salary' => 'required|numeric',
    ]);

    // Set user_id to the currently authenticated user's ID
    $validated['user_id'] = Auth::id();

    // Create the job
    Job::create($validated); // Ensure this creates the job in the database
    return redirect()->route('admin.dashboard')->with('success', 'Job created successfully.');
}
public function edit($id)
{
    $job = Job::findOrFail($id);
    return view('admin.edit', compact('job')); // Return the edit view with job data
}

public function update(Request $request, $id)
{
    // Validate and update the job data
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'location' => 'required|string|max:255',
        'salary' => 'required|numeric',
    ]);

    $job = Job::findOrFail($id);
    $job->update($validated); // Update the job in the database

    return redirect()->route('admin.dashboard')->with('success', 'Job updated successfully.');
}

public function destroy($id)
{
    $job = Job::findOrFail($id);
    $job->delete(); // Delete the job from the database

    return redirect()->route('admin.dashboard')->with('success', 'Job deleted successfully.');
}

    
}
