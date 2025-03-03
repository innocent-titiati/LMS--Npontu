<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\NotificationController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::resource('courses', CourseController::class);

Route::resource('modules', ModuleController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('assessments', AssessmentController::class);
});

Route::post('/enroll', [EnrollmentController::class, 'enroll']);
Route::get('/enrollments', [EnrollmentController::class, 'index']);

Route::get('/instructors', [InstructorController::class, 'index']);
Route::post('/assign-course', [InstructorController::class, 'assignCourse']);


