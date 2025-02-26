<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\CourseMaterialController;
use App\Http\Controllers\CourseInstructorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', HomeController::class)->name('home');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/register', [RegisterController::class, 'show'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

Route::resource('users', UserController::class);
Route::resource('courses', CourseController::class);
Route::resource('enrollments', EnrollmentController::class);
Route::resource('certifications', CertificationController::class);
Route::resource('messages', MessageController::class);
Route::resource('questions', QuestionController::class);
Route::resource('modules', ModuleController::class);
Route::resource('course-materials', CourseMaterialController::class);
Route::resource('course-instructors', CourseInstructorController::class);

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/student.php';
