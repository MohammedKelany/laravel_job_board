<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("employers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "company_name" => "string|min:3|max:255"
        ]);
        $request->user()->employer()->create([
            "company_name" => $data["company_name"],
        ]);
        return redirect()->route("my-jobs.index")
            ->with("success", "Registered as Employer!");
    }
}
