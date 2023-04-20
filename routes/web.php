<?php

use App\Http\Livewire\Auth\LoginComponent;
use App\Http\Livewire\Pages\DashboardComponent;
use App\Http\Livewire\Pages\Profile;
use App\Http\Livewire\Pages\School\Classes\{Index, Create, Join, ListClasses, ViewClasses};
use App\Http\Livewire\Pages\School\Classes\Materials\Create as MaterialsCreate;
use App\Http\Livewire\Pages\School\Classes\Materials\Index as MaterialsIndex;
use App\Http\Livewire\Pages\School\Classes\Materials\Edit as MaterialsEdit;
use App\Http\Livewire\Pages\School\Classes\Materials\Views as MaterialsView;
use App\Http\Livewire\Pages\School\Classes\Assignments\Index as AssignmentsIndex;
use App\Http\Livewire\Pages\School\Classes\Assignments\Create as AssignmentsCreate;
use App\Http\Livewire\Pages\School\Classes\Assignments\Edit as AssignmentsEdit;
use App\Http\Livewire\Pages\School\Dashboard;
use App\Http\Livewire\Pages\Users\Students\Create as StudentsCreate;
use App\Http\Livewire\Pages\Users\Students\Edit as StudentsEdit;
use App\Http\Livewire\Pages\Users\Students\Index as StudentsIndex;
use App\Http\Livewire\Pages\Users\Teacher\Create as TeacherCreate;
use App\Http\Livewire\Pages\Users\Teacher\Edit as TeacherEdit;
use App\Http\Livewire\Pages\Users\Teacher\Index as TeacherIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get("login", LoginComponent::class)->name("login");
});
Route::middleware('auth')->group(function () {
    Route::get("/", DashboardComponent::class)->name("dashboard");
    Route::get("/profile/{username}", Profile::class)->name("profile");

    Route::prefix('users')->name('users.')->group(function () {
        Route::prefix('students')->name('students.')->group(function () {
            Route::get("", StudentsIndex::class)->name("index");
            Route::get("/create", StudentsCreate::class)->name("create");
            Route::get("/{studentId}/edit", StudentsEdit::class)->name("edit");
        });
        Route::prefix('teachers')->name('teachers.')->group(function () {
            Route::get("", TeacherIndex::class)->name("index");
            Route::get("/create", TeacherCreate::class)->name("create");
            Route::get("/{teacherId}/edit", TeacherEdit::class)->name("edit");
        });
    });
    Route::prefix('school')->name('school.')->group(function () {
        Route::get("/dashboard", Dashboard::class)->name("dashboard");
        Route::prefix('classes')->name('classes.')->group(function () {
            Route::get("", Index::class)->name("index");
            Route::get("/create", Create::class)->name("create");
            Route::get("/list", ListClasses::class)->name("list");
            Route::get("/join", Join::class)->name("join");
            Route::get("/view/{classesId}", ViewClasses::class)->name("view");

            Route::prefix('/{classesId}/materials')->name('materials.')->group(function () {
                Route::get("", MaterialsIndex::class)->name("index");
                Route::get("/create", MaterialsCreate::class)->name("create");
                Route::get("/{materialsId}/edit", MaterialsEdit::class)->name("edit");
                Route::get("/{materialsId}/view", MaterialsView::class)->name("view");
            });
            Route::prefix('/{classesId}/assignments')->name('assignments.')->group(function () {
                Route::get("", AssignmentsIndex::class)->name("index");
                Route::get("/create", AssignmentsCreate::class)->name("create");
                Route::get("/{assignmentsId}/edit", AssignmentsEdit::class)->name("edit");
            });
        });
    });
});
