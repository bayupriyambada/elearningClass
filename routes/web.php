<?php

use App\Http\Livewire\Auth\LoginComponent;
use App\Http\Livewire\Pages\DashboardComponent;
use App\Http\Livewire\Pages\Profile;
use App\Http\Livewire\Pages\School\Classes\{Index, Create, Join, ListClasses, ViewClasses};
use App\Http\Livewire\Pages\School\Classes\Materials\Create as MaterialsCreate;
use App\Http\Livewire\Pages\School\Classes\Materials\Index as MaterialsIndex;
use App\Http\Livewire\Pages\School\Classes\Materials\Edit as MaterialsEdit;
use App\Http\Livewire\Pages\School\Dashboard;
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

    Route::prefix('school')->name('school.')->group(function () {
        Route::get("/dashboard", Dashboard::class)->name("dashboard");
        Route::prefix('classes')->name('classes.')->group(function () {
            Route::get("", Index::class)->name("index");
            Route::get("/create", Create::class)->name("create");
            Route::get("/list", ListClasses::class)->name("list");
            Route::get("/join", Join::class)->name("join");
            Route::get("/view/{classesId}", ViewClasses::class)->name("view");

            Route::prefix('/{classesId}/materials')->name('materials.')->group(function () {
                Route::get("/", MaterialsIndex::class)->name("index");
                Route::get("/create", MaterialsCreate::class)->name("create");
                Route::get("/{materialsId}/edit", MaterialsEdit::class)->name("edit");
            });
        });
    });
});
