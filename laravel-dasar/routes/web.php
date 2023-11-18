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

Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])
->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/response/hello',[\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header',[\App\Http\Controllers\ResponseController::class, 'header']);
/**
Route::get('/response/type/view',[\App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/type/json',[\App\Http\Controllers\ResponseController::class, 'responseJson']);
Route::get('/response/type/file',[\App\Http\Controllers\ResponseController::class, 'responseFile']);
Route::get('/response/type/download',[\App\Http\Controllers\ResponseController::class, 'responseDownload']);
 */

Route::prefix('/response/type')->group(function (){
    Route::get('/view',[\App\Http\Controllers\ResponseController::class, 'responseView']);
    Route::get('/json',[\App\Http\Controllers\ResponseController::class, 'responseJson']);
    Route::get('/file',[\App\Http\Controllers\ResponseController::class, 'responseFile']);
    Route::get('/download',[\App\Http\Controllers\ResponseController::class, 'responseDownload']);
});

/**
Route::get('/cookie/set', [\App\Http\Controllers\CookieController::class,'createCookie']);
Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class,'getCookie']);
Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class,'clearCookie']);
 */
Route::controller(\App\Http\Controllers\CookieController::class)->group(function (){
    Route::get('/cookie/set','createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});

Route::get('/redirect/to', [\App\Http\Controllers\RedirectController::class,'redirectTo']);
Route::get('/redirect/from', [\App\Http\Controllers\RedirectController::class,'redirectFrom']);
Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class,'redirectName']);
Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class,'redirectHello'])
    ->name('redirect-hello');
Route::get('/redirect/named', function (){
    //return route('redirect-hello',['name'=> 'roni']);
    //return url()->route('redirect-hello',['name'=> 'roni']);
    return \Illuminate\Support\Facades\URL::route('redirect-hello',['name'=> 'roni']);
});
Route::get('/redirect/action', [\App\Http\Controllers\RedirectController::class,'redirectAction']);
Route::get('/redirect/away', [\App\Http\Controllers\RedirectController::class,'redirectAway']);

/**
Route::get('/middleware/api', function (){
    return "Middleware OK";
})->middleware(['sample:XYZ,401']);
//})->middleware(['sample']);

Route::get('/middleware/group', function (){
    return "GROUP";
})->middleware(['xyz']);
//})->middleware(['xyz']);
 */

/**
Route::middleware(['sample:XYZ,401'])->group(function (){
    Route::get('/middleware/api', function (){
        return "Middleware OK";
    });

    Route::get('/middleware/group', function (){
        return "GROUP";
    });
});
 */

Route::middleware(['sample:XYZ,401'])->prefix('/middleware')->group(function (){
    Route::get('/api', function (){
        return "Middleware OK";
    });

    Route::get('/group', function (){
        return "GROUP";
    });
});

Route::get('/form', [\App\Http\Controllers\FormController::class,'form']);
Route::post('/form', [\App\Http\Controllers\FormController::class,'submitForm']);

Route::get('/url/current', function (){
    return \Illuminate\Support\Facades\URL::full();
});

Route::get('/url/action', function (){
    //return action([\App\Http\Controllers\FormController::class,'form'],[]);
    //return url()->action([\App\Http\Controllers\FormController::class,'form'],[]);
    return \Illuminate\Support\Facades\URL::action([\App\Http\Controllers\FormController::class,'form'],[]);
});

Route::get('/session/create',[\App\Http\Controllers\SessionController::class,'createSession']);
Route::get('/session/get',[\App\Http\Controllers\SessionController::class,'getSession']);

Route::get('/error/sample', function (){
    throw new Exception('Sample Error');
});

Route::get('/error/manual', function (){
    report(new Exception("Sample error"));
    return "OK";
});

Route::get('/error/validation', function (){
    throw new \App\Exceptions\ValidationException("Validation error");
});

Route::get('/abort/400', function (){
    abort(400, "Ups something happens!!, ga sengaja terjadi!!");
});

Route::get('/abort/401', function (){
    abort(401,"Ups something happens!!, ga punya akses!!");
});

Route::get('/abort/402', function (){
    abort(402,"Ups something happens!!, ga sengaja ke penceti!!");
});

Route::get('/abort/500', function (){
    abort(500,"Ups something happens!!, ga anunya masuk!!");
});

Route::get('/abort/403', function (){
    abort(403);
});
