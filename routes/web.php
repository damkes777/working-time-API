<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(EmployeesController::class)
     ->group(function () {
         Route::post('employee/create', 'create')
              ->name('employee.create');
     });
