<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/courses', [CourseController::class, 'store'])->middleware('role:manager');
    Route::post('/enrollments/{id}/approve', [EnrollmentController::class, 'approve'])->middleware('role:manager');
});


