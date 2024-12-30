<?php

use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('admin/add-student', [AdminController::class, 'addStudent'])->name('admin.add-student');
    Route::post('admin/create-schedule', [AdminController::class, 'createSchedule'])->name('admin.create-schedule');
});


