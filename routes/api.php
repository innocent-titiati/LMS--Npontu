<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserMessagesController;
use App\Http\Controllers\CertificationsController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\CourseModuleController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController; // Import UserController

// User Messages Routes
Route::apiResource('user_messages', UserMessagesController::class);

// Certifications Routes
Route::apiResource('certifications', CertificationsController::class);

// Instructors Routes
Route::apiResource('instructors', InstructorController::class);

// Quizzes Routes
Route::apiResource('quizzes', QuizController::class);

// Course Materials Routes
Route::apiResource('course_materials', CourseMaterialController::class);

// Modules Routes
Route::apiResource('modules', ModuleController::class);

// Courses Routes
Route::apiResource('courses', CourseController::class);

// User Roles Routes
Route::apiResource('user_role', UserRoleController::class);

// Course-Module Routes
Route::post('courses/{courseId}/modules', [CourseModuleController::class, 'attachModule']);
Route::delete('courses/{courseId}/modules/{moduleId}', [CourseModuleController::class, 'detachModule']);
Route::put('courses/{courseId}/modules/order', [CourseModuleController::class, 'updateOrder']);

// Enrollment Routes
Route::apiResource('enrollments', EnrollmentController::class);

// User Routes
Route::post('register', [UserController::class, 'register']); // User registration
Route::post('login', [UserController::class, 'login']); // User login
Route::get('users', [UserController::class, 'index']); // Get all users
Route::get('users/{id}', [UserController::class, 'show']); // Get a specific user
Route::put('users/{id}', [UserController::class, 'update']); // Update a specific user
Route::delete('users/{id}', [UserController::class, 'destroy']); // Delete a specific user
