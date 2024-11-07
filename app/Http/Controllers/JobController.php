<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use App\Models\AppliedJob; // Added for the applied jobs
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class JobController extends Controller
{
    // Display list of jobs
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    // Show details of a single job
    // Show details of a single job
public function show($id)
{
    $job = Job::findOrFail($id);
    
    // Check if the current user has applied for this job
    $hasApplied = DB::table('applied_jobs')
                ->where('job_id', $id) // The ID of the job
                ->where('user_id', Auth::id()) // The ID of the currently authenticated user
                ->exists(); // Returns true if the record exists, false otherwise

    
    return view('jobs.show', compact('job', 'hasApplied'));
}


    // Show the application form for a job
    public function apply(Request $request, $id)
    {
        $job = Job::findOrFail($id); // Find the job by ID
        return view('jobs.apply', compact('job')); // Pass job details to the view
    }

    // Store the application details in the database
    public function submitApplication(Request $request, $id)
{
    // Validate form inputs
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phno' => 'required|numeric',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'qualification' => 'required|in:10th,12th,UG,PG',
        'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        'location_preference' => 'nullable|string|max:255',
    ]);

    // Handle file uploads
    $photoPath = $request->file('photo')->store('photos', 'public');
    $resumePath = $request->file('resume') ? $request->file('resume')->store('resumes', 'public') : null;

    // Check if the user has already applied for this job
    $alreadyApplied = DB::table('applied_jobs')
                        ->where('user_id', Auth::id()) // Check if user is authenticated
                        ->where('job_id', $id) // Check for job ID
                        ->exists();

    // If user has already applied, return with a message
    if ($alreadyApplied) {
        return redirect()->route('jobs.show', $id)
                         ->with('error', 'You have already applied to this job.');
    }

    // Store the application in the applications table
    Application::create([
        'job_id' => $id,
        'user_id' => Auth::id(),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phno,
        'photo' => $photoPath,
        'qualification' => $request->qualification,
        'resume' => $resumePath,
        'location_preference' => $request->location_preference,
    ]);

    // Store in the applied_jobs table to track the user's application
    DB::table('applied_jobs')->insert([
        'user_id' => Auth::id(),
        'job_id' => $id,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Redirect back to the job's page with a success message
    return redirect()->route('jobs.show', $id)
                     ->with('success', 'Your application has been submitted successfully.');
}


    // Search for jobs based on query
    public function search(Request $request)
    {
        $query = $request->input('query');
        $jobs = Job::where('title', 'LIKE', "%$query%")
                    ->orWhere('description', 'LIKE', "%$query%")
                    ->orWhere('location','LIKE',"%$query%")
                    ->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    // Show the applied jobs for the logged-in user
    public function showAppliedJobs()
    {
        // Fetch the jobs that the authenticated user has applied to
        $appliedJobs = Auth::user()->appliedJobs()->with('job')->get();

        // Return the view to display the applied jobs
        return view('jobs.applied', compact('appliedJobs'));
    }
}
