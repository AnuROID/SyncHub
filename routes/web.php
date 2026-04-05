<?php

use App\Http\Controllers\ProfileController;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth','verified'])->group(function(){
Route::get('/dashboard', function () {
    $projects = Project::where('user_id', Auth()->id())->
        orWhereHas('members', function ($q) {
            $q->where('user_id', auth()->id());
        })->get();
    return view('dashboard', compact('projects'));
})->name('dashboard');

Route::get('/projects/{project}', function (Project $project) {
    if ($project->user_id !== auth()->id() && !$project->members->contains(auth()->id())) {
        abort(403, "You aren't ivited to this sync board!");

    }
    return view('project-show', compact('project'));

})->name('projects.show');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

});






require __DIR__ . '/auth.php';
