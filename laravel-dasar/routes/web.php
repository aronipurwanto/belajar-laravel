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

Route::get('/sitera', function (){
    return "welcome to sitera";
});

Route::redirect('/youtube','/sitera');

Route::fallback(function (){
   return '404';
});

Route::view('/hello','hello',['name' => 'Roni Purwanto']);

Route::get('/hello-again', function () {
    return view('hello',['name' => 'Roni Purwanto']);
});

Route::get('/hello-world', function () {
    return view('hello.world',['name' => 'Roni Purwanto']);
});

Route::get('/product/{id}', function ($productId){
    return "Product $productId";
})->name('product.detail');

Route::get('/product/{product}/item/{items}', function ($productId, $itemId){
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/category/{id}', function ($categoryId){
    return "Category $categoryId";
})->where('id','[0-9]+')
->name('category.detail');

Route::get('/users/{id?}', function ($userId = '404'){
    return "User $userId";
})->name('user.detail');

Route::get('/conflict/{name}', function ($name){
    return "Conflict $name";
})->name('conflict.detail');

Route::get('/conflict/roni', function (){
    return "Conflict Roni";
});

Route::get('/produk/{id}', function ($id){
    $link = route('product.detail',['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id){
    return redirect()->route('product.detail',['id'=>$id]);
});


Route::get('/controller/hello',[\App\Http\Controllers\HelloController::class, 'hello']);
Route::get('/controller/say-hello/{name}',[\App\Http\Controllers\HelloController::class, 'sayHello']);
Route::get('/controller/request',[\App\Http\Controllers\HelloController::class, 'request']);

Route::get('/input/hello',[\App\Http\Controllers\InputController::class,'hello']);
Route::post('/input/hello',[\App\Http\Controllers\InputController::class,'hello']);
Route::post('/input/hello/first',[\App\Http\Controllers\InputController::class,'first']);
Route::post('/input/hello/input',[\App\Http\Controllers\InputController::class, 'input']);
Route::post('/input/hello/input-array',[\App\Http\Controllers\InputController::class, 'inputArray']);
Route::post('/input/filter/only',[\App\Http\Controllers\InputController::class, 'inputOnly']);
Route::post('/input/filter/except',[\App\Http\Controllers\InputController::class, 'inputExcept']);

Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload']);

Route::get('/response/hello',[\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header',[\App\Http\Controllers\ResponseController::class, 'header']);
Route::get('/response/type/view',[\App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/type/json',[\App\Http\Controllers\ResponseController::class, 'responseJson']);
Route::get('/response/type/file',[\App\Http\Controllers\ResponseController::class, 'responseFile']);
Route::get('/response/type/download',[\App\Http\Controllers\ResponseController::class, 'responseDownload']);

Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class,'createCookie']);
Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class,'getCookie']);
Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class,'clearCookie']);
