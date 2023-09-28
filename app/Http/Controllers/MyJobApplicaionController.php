<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MyJobApplicaionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            "my_jobs_applications.index",
            [
                "applications" => auth()->user()->jobApplications()->with([
                    "job" => fn ($query) => $query
                        ->withCount("jobApplications")
                        ->withAvg("jobApplications", "expected_salary"),
                    "job.employer"
                ])->latest()->get()
            ],
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $my_jobs_applicaion)
    {
        $my_jobs_applicaion->delete();

        return redirect()->back()->with("success", "Application Canceled!");
    }
}
