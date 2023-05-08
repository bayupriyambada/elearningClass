<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Auth\LoginComponent;
use App\Http\Livewire\Pages\School\Dashboard;
use App\Http\Livewire\Pages\School\Classes\SubLesson\Show;
use App\Http\Livewire\Pages\School\Classes\SubLesson\Task;
use App\Http\Livewire\Pages\{Profile, DashboardComponent};
use App\Http\Livewire\Pages\School\Classes\SubLesson\ListSub;
use App\Http\Livewire\Pages\School\Classes\SubLesson\Ranking;
use App\Http\Livewire\Pages\Users\Teacher\Index as TeacherIndex;
use App\Http\Livewire\Pages\School\Classes\{AverageClass, Index};
use App\Http\Livewire\Pages\Users\Students\Index as StudentsIndex;
use App\Http\Livewire\Pages\Users\Attendances\Index as AttendancesIndex;
use App\Http\Livewire\Pages\School\Classes\SubLesson\View as SubLessonView;
use App\Http\Livewire\Pages\LessonCategories\Index as LessonCategoriesIndex;
use App\Http\Livewire\Pages\School\Classes\SubLesson\Index as SubLessonIndex;

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
            Route::get("{lessonId}/average-student", AverageClass::class)->name("average");
            Route::get("{lessonId}/sub-lesson", SubLessonIndex::class)->name("sub.index");
            Route::get("{lessonId}/sub-lesson/list", ListSub::class)->name("sub.list");
            Route::get("{lessonId}/sub-lesson/view/{subLessonId}", SubLessonView::class)->name("sub.view");
            Route::get("{lessonId}/subLesson/preview/{subLessonId}", Show::class)->name("sub.show");
            Route::get("{lessonId}/subLesson/task/{subLessonId}/answer", Task::class)->name("sub.task");
            Route::get("{lessonId}/track-assessment/task", Ranking::class)->name("tracking.rank");
        });
    });
});
