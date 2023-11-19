<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function (){
    return view('hello',['name'=>'Laravel']);
});

Route::get('/world', function (){
    return view('hello.world',['name'=>'Laravel']);
});

// sample hack
/**
 * http://localhost:8000/html-encoding?name=%3Cscript%3Ealert(%27anda%20di%20heck%27);%3C/script%3E
 */
Route::get('/html-encoding', function (\Illuminate\Http\Request $request){
    return view("html-encoding", ["name" => $request->input("name")]);
});
