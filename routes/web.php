<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobApplicaionController;
use App\Http\Controllers\MyJobsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::resource('jobs', JobController::class);

Route::get('/', function () {
    return redirect()->route("jobs.index");
})->name("/");

Route::middleware("auth")->group(function () {

    Route::resource('jobs.applications', JobApplicationController::class)
        ->only(["create", "store"]);
    Route::resource('my-jobs-applicaions', MyJobApplicaionController::class)
        ->only(["index", "destroy"]);
});

Route::resource("employers", EmployerController::class)
    ->only("create", "store")->middleware("auth");

Route::middleware("employer")->group(function () {
    Route::resource("my-jobs", MyJobsController::class);
});

require __DIR__ . '/auth.php';

// Route::fallback(function () {
//     return redirect()->route("jobs.index");
// });