<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\WorkingTimesController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(EmployeesController::class)
     ->group(function () {
         Route::post('employee/create', 'create')
              ->name('employee.create');
     });
Route::controller(WorkingTimesController::class)
     ->group(function () {
         Route::post('working-time/register', 'timeRegistration')
              ->name('working-time.register');
     });
