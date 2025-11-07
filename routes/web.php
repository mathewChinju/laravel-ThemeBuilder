<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectNewController;

Route::get('/', function () {
    return view('welcome');//6/6/25 ==== welcome
});
 
Route::post('/projects/{project}/update-html', [ProjectNewController::class, 'updateHtmlContent'])->name('projects.update.html');

 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Project Routes
Route::middleware(['auth'])->group(function () {
    

    Route::get('/new-projects', [ProjectNewController::class, 'index'])->name('projects_new.index');
    // Route::get('/new-projects/create', [ProjectNewController::class, 'create'])->name('projects_new.create');
    Route::post('/new-projects', [ProjectNewController::class, 'store'])->name('projects_new.store');
    // Route::get('/new-projects/{project}/preview', [ProjectNewController::class, 'generatePreview'])->name('projects_new.preview');
    Route::get('/new-projects/{project}/edit', [ProjectNewController::class, 'editPrompt'])->name('projects_new.edit');
    Route::put('/new-projects/{project}', [ProjectNewController::class, 'updatePrompt'])->name('projects_new.update');
    Route::delete('/new-projects/prompt-history/{history}', [ProjectNewController::class, 'deletePromptHistory'])->name('prompt-history.delete');

    Route::get('/new-projects/{project}', [ProjectNewController::class, 'show'])->name('projects_new.show');
    Route::get('/new-projects/history/{historyId}', [ProjectNewController::class, 'showHistory'])->name('projects_new.showHistory');
 

    Route::get('/ai/projects', [ProjectController::class, 'index'])->name('ai.index');  
    Route::post('/ai/projects', [ProjectController::class, 'store'])->name('ai.store');
    Route::get('/ai/projects/download', [ProjectController::class, 'downloadZip'])->name('ai.download');
    Route::post('/ai/projects/clear-preview', [ProjectController::class, 'clearPreview'])->name('ai.clearPreview');
    Route::post('/ai/projects/revert-layout', [ProjectController::class, 'revertLayout'])->name('ai.revertLayout');

 
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class,'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/view/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/status/{id}', [UserController::class, 'statusupdate'])->name('users.statusupdate');

});// Project Routes
require __DIR__.'/auth.php';
