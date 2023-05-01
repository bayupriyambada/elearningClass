<?php

use App\Http\Livewire\Auth\LoginComponent;
use App\Http\Livewire\Pages\{Profile, DashboardComponent};
use App\Http\Livewire\Pages\LessonCategories\Index as LessonCategoriesIndex;
use App\Http\Livewire\Pages\School\Classes\{Index, Create, Edit, ListClasses, ViewClasses};
use App\Http\Livewire\Pages\School\Classes\Materials\{Views as MaterialsView, Edit as MaterialsEdit, Index as MaterialsIndex, Create as MaterialsCreate};
use App\Http\Livewire\Pages\School\Classes\Assignments\{View as AssignmentsView, Edit as AssignmentsEdit, Create as AssignmentsCreate, Index as AssignmentsIndex, SubmitAssignment};
use App\Http\Livewire\Pages\School\Classes\SubLesson\Index as SubLessonIndex;
use App\Http\Livewire\Pages\School\Classes\SubLesson\ListSub;
use App\Http\Livewire\Pages\School\Classes\SubLesson\Show;
use App\Http\Livewire\Pages\School\Classes\SubLesson\View as SubLessonView;
use App\Http\Livewire\Pages\Users\Students\Index as StudentsIndex;
use App\Http\Livewire\Pages\Users\Teacher\Index as TeacherIndex;
use App\Http\Livewire\Pages\School\Dashboard;
use App\Http\Livewire\Pages\Users\Attendances\Index as AttendancesIndex;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get("login", LoginComponent::class)->name("login");
});
Route::middleware('auth')->group(function () {
    Route::get("/", DashboardComponent::class)->name("dashboard");
    Route::get("/profile", Profile::class)->name("profile");

    Route::prefix('users')->name('users.')->group(function () {
        Route::prefix('students')->name('students.')->group(function () {
            Route::get("", StudentsIndex::class)->name("index");
        });
        Route::prefix('teachers')->name('teachers.')->group(function () {
            Route::get("", TeacherIndex::class)->name("index");
        });
        Route::prefix('attendances')->name('attendances.')->group(function () {
            Route::get("", AttendancesIndex::class)->name("index");
        });
    });
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get("/lesson-categories", LessonCategoriesIndex::class)->name("lesson.index");
    });

    Route::prefix('school')->name('school.')->group(function () {
        Route::get("/dashboard", Dashboard::class)->name("dashboard");
        Route::prefix('classes')->name('classes.')->group(function () {
            Route::get("", Index::class)->name("index");
            Route::get("{lessonId}/sub-lesson", SubLessonIndex::class)->name("sub.index");
            Route::get("{lessonId}/sub-lesson/list", ListSub::class)->name("sub.list");
            Route::get("{lessonId}/sub-lesson/view/{subLessonId}", SubLessonView::class)->name("sub.view");
            Route::get("{lessonId}/subLesson/preview/{subLessonId}", Show::class)->name("sub.show");
            // Route::get("{lessonId}/sub-lesson/view", SubLessonView::class)->name("sub.view");
            Route::get("/create", Create::class)->name("create");
            Route::get("/{classesId}/edit", Edit::class)->name("edit");
            Route::get("/list", ListClasses::class)->name("list");
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
                Route::get("/{assignmentId}/edit", AssignmentsEdit::class)->name("edit");
                Route::get("/{assignmentId}/view", AssignmentsView::class)->name("view");
                Route::get("/{assignmentId}/submitAssignment", SubmitAssignment::class)->name("submit");
            });
        });
    });
});
