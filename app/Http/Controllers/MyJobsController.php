<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class MyJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = auth()->user()->employer->jobs()->with(["jobApplications", "employer"])->get();
        return view("my_jobs.index", ["jobs" => $jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create", Job::class);
        return view("my_jobs.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        $this->authorize("create", Job::class);
        $data = $request->validated();
        $request->user()->employer->jobs()->create($data);
        return redirect()->route("my-jobs.index")
            ->with("success", "Job Created Successfully!");
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
    public function edit(Job $my_job)
    {
        $this->authorize("update", $my_job);
        return view("my_jobs.edit", ["my_job" => $my_job]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $my_job)
    {
        $this->authorize("update", $my_job);
        $data = $request->validated();
        // dd($data);
        $my_job->update($data);

        return redirect()->route("my-jobs.index")
            ->with("success", "Job Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $my_job)
    {
        $this->authorize("delete", $my_job);
        $my_job->delete();
        return redirect()->route("my-jobs.index");
    }
}
