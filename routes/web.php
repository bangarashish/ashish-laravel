<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CountryStateCityController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FilesController;

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
/* practice template route */
   // Route::get('/practice', function(){
   //    print_r($employee);
   // });

//  Route::get('/practice', function(){
//     return view('practice');
//  });

 /* practice template route */

/* -----Route middleware with login logout------ */
Route::get('/login', function(){
   session()->put('user_id', 1);
   echo "logged in";
   //return redirect('/');
   //die;
   // echo '<pre>';
   // print_r(session()->all());
});
Route::get('/no-access', function(){
   echo "You are not allowed";
   die;
   // echo '<pre>';
   //print_r(session());
});

Route::get('/logout', function(){
   session()->forget('user_id');
   return redirect('/demo');
});

/* -----Route middleware with login logout---- */

// Route::get('/', function () {
//     return view('backend.users.create');
// });
Route::get('/demo', [UserController::class, 'create']);
Route::post('/store', [UserController::class, 'store']);

// Route::get('/create', [NewUserController::class, 'create']);
// Route::post('/store', [NewUserController::class, 'store']);

//Route::get('/demo', [IndexController::class, 'index']);
//Route::get('/join', [IndexController::class, 'joins']);


/*     Country states and city route   */

// Route::get('/country', [CountryStateCityController::class, 'index']);
// Route::post('/fetch-states/{$id}', [CountryStateCityController::class, 'fetchState']);
// Route::post('/fetch-cities/{$id}', [CountryStateCityController::class, 'fetchCity']);

Route::get('/test', [CountryStateCityController::class, 'getStates']);

Route::get('dropdown', [CountryStateCityController::class, 'view'])->name('dropdownView');
Route::get('get-states', [CountryStateCityController::class, 'getStates'])->name('getStates');
Route::get('get-cities', [CountryStateCityController::class, 'getCities'])->name('getCities');

/*     Country states and city route  */

/* Employee table Route */
//Route::get('/employee', [EmployeeController::class, 'index']);
//Route::get('/employee', [EmployeeController::class, 'newindex'])->middleware('guard');
Route::get('/employee', [EmployeeController::class, 'newindex']);
//Route::get('/edit/{edit}', [EmployeeController::class, 'edit']);
//Route::post('/update/{id}', [EmployeeController::class, 'update']);
//Route::get('/employee-view/', [EmployeeController::class, 'employee_view'])->name('employee-view');
//Route::get('/employee-view/', [EmployeeController::class, 'employee_view']);

//Route::get('/view-employee/{id}', [EmployeeController::class, 'view']);

Route::post('employee-add', [EmployeeController::class, 'employee_add']);
Route::get('/employee-table', [EmployeeController::class, 'employee_table']);
Route::get('view-data', [EmployeeController::class, 'view_data']);
Route::post('/update-employee/{id}', [EmployeeController::class, 'update']);
Route::get('delete-employee', [EmployeeController::class, 'delete_employee']);
Route::get('search', [EmployeeController::class, 'search_table']);
Route::get('/pagination', [EmployeeController::class, 'view_pagination']);
Route::get('/sorting', [EmployeeController::class, 'view_sorting']);
/* Employee table Route */ 



/*-------------------- File Upload--------------- */

Route::get('/file', [FilesController::class, 'create']);
Route::post('/filesUpload', [FilesController::class, 'store']);
Route::post('/updatefile/{id}', [FilesController::class, 'edit']);
Route::get('/viewfile/{id}', [FilesController::class, 'view']);
Route::get('/deletefile/{id}', [FilesController::class, 'destroy']);



//Route::get('/filetest', [FilesController::class, 'view']);
   

/*-------------------- File Upload--------------- */


/*-------------------- curl in php --------------- */

Route::get('/curl', function(){
   return view('backend.curl.index');
});

Route::get('/datatable', [EmployeeController::class, 'index']);
Route::get('/curl-api', [EmployeeController::class, 'curl_api']);


/*-------------------- curl in php --------------- */