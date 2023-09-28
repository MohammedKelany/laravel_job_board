<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $this->authorize("apply", $job);
        return view("jobs.applications.create", ["job" => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Job $job)
    {
        $this->authorize("apply", $job);
        $data = $request->validate([
            "expected_salary" => "required|integer|max:150000|min:5000",
            "cv" => "required|file|mimes:pdf,doc,docx|max:2048"
        ]);
        $cv = $request->file("cv");
        $path = $cv->store("cvs", "public");

        $job->jobApplications()->create([
            "expected_salary" => $data["expected_salary"],
            "cv" => $path,
            "user_id" => $request->user()->id,
        ]);
        return redirect()->route("jobs.show", ["job" => $job])->with("success", "Job Applecation Created Successfully!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
