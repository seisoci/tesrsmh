<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\PagesController as BackendPagesController;
use App\Http\Controllers\Backend\UsersController as BackendUsersController;
use App\Http\Controllers\Backend\RolesController as BackendRolesController;
use App\Http\Controllers\Backend\FormationsController as BackendFormationsController;
use App\Http\Controllers\Backend\ApplicantsController as BackendApplicantsController;
use App\Http\Controllers\Backend\TesterController as BackendTesterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RegistrationController;
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

// Route::get('/', [PagesController::class, 'index']);


// // Demo routes
// Route::get('/datatables', 'PagesController@datatables');
// Route::get('/ktdatatables', 'PagesController@ktDatatables');
// Route::get('/select2', 'PagesController@select2');
// Route::get('/jquerymask', 'PagesController@jQueryMask');
// Route::get('/icons/custom-icons', 'PagesController@customIcons');
// Route::get('/icons/flaticon', 'PagesController@flaticon');
// Route::get('/icons/fontawesome', 'PagesController@fontawesome');
// Route::get('/icons/lineawesome', 'PagesController@lineawesome');
// Route::get('/icons/socicons', 'PagesController@socicons');
// Route::get('/icons/svg', 'PagesController@svg');

// // Quick search dummy route to display html elements in search dropdown (header search)
Route::get('backend', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('backend', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::view('/success', 'frontend.success');
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');
Route::get('/test', BackendTesterController::class);
Route::get('/', [IndexController::class, 'index']);
Route::get('/registration/{id}', [RegistrationController::class, 'show']);
Route::post('/registration/{id}', [RegistrationController::class, 'store']);
Route::get('/{id}', [IndexController::class, 'show']);

Route::middleware('auth:web')->group( function () {
  Route::group(['middleware' => ['role:super-admin']], function () {
    Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
        Route::get('applicants/select2', [BackendApplicantsController::class, 'select2'])->name('applicants.select2');
        Route::resource('pages', BackendPagesController::class)->except('show');
        Route::resource('users', BackendUsersController::class)->except('show');
        Route::resource('roles', BackendRolesController::class)->except(['create', 'show', 'update', 'destroy']);
        Route::resource('formations', BackendFormationsController::class)->except(['show', 'edit', 'create']);
        Route::resource('applicants', BackendApplicantsController::class)->except(['edit','edit','create']);
    });
  });
  // Route::group(['middleware' => ['role:writer']], function () {
  //   Route::group(['prefix' => 'backend', 'as' => 'backend.'], function () {
  //       Route::get('applicants/select2', [BackendApplicantsController::class, 'select2'])->name('applicants.select2');
  //       Route::resource('pages', BackendPagesController::class)->except('show');
  //       Route::resource('users', BackendUsersController::class)->except('show');
  //       Route::resource('roles', BackendRolesController::class);
  //       Route::resource('formations', BackendFormationsController::class)->except(['show', 'edit', 'create']);
  //       Route::resource('applicants', BackendApplicantsController::class)->except(['edit','edit','create']);
  //   });
  // });
});
