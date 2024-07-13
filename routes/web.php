<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controller\AdminController;


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

Route::get('/item', function () {
    return view('item');
})->middleware(['auth', 'verified'])->name('item');



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
});


//item追加
Route::get('/items', [App\Http\Controllers\ItemController::class,'index'])->name('crud.index');
//アイテム編集
Route::get('/edit/{id}',[App\Http\Controllers\ItemController::class, 'edit'])->name('edit');
Route::get('/itemEdit/{id}',[App\Http\Controllers\ItemController::class, 'itemEdit'])->name('itemEdit');
Route::post('/itemEdit/{id}', [App\Http\Controllers\ItemController::class, 'itemEdit'])->name('itemEdit.post');
//アイテム編集
Route::get('/destroy/{id}',[App\Http\Controllers\ItemController::class, 'destroy'])->name('destroy');


//user 一覧
Route::get('/users', [App\Http\Controllers\UserController::class,'index'])->name('users.index');
//リンクが来たら編集画面へ
Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'userEdit'])->name('userEdit');
//詳細から削除へリンクが来たら削除実行
Route::post('/users/{id}/destroy', [App\Http\Controllers\UserController::class, 'userDestroy'])->name('userDestroy');
///リンクが来たら更新
Route::post('/users/{id}/update', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
//ユーザー登録用
Route::get('/userRegister', [App\Http\Controllers\UserController::class,'userRegister'])->name('userRegister');
//ユーザー削除
Route::get('/userDestroy/{id}', [App\Http\Controllers\UserController::class,'userDestroy'])->name('userDestroy');

Route::post('/userCreate', [App\Http\Controllers\UserController::class,'userCreate'])->name('userCreate');



Route::post('/user/register', function(Request $request) {
    $data = $request->all();

    // バリデーション処理
    $validator = (new UserController)->validator($data);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // ユーザー作成処理
    $user = (new UserController)->userCreate($data);

    // ユーザー登録が成功した場合のリダイレクトなどの処理
    return redirect('/')->with('success', 'ユーザー登録が完了しました');
});




//item検索
Route::get('/search', [App\Http\Controllers\SearchController::class,'index'])->name('index');
//item検索から検索が来たらresultへ
Route::post('/search/result', [App\Http\Controllers\SearchController::class,'result'])->name('result');
Route::get('/search/result', [App\Http\Controllers\SearchController::class,'result'])->name('result');
Route::get('/search/{id}/edit',[App\Http\Controllers\ItemController::class, 'edit'])->name('edit');




//ミドルウェアに遷移
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
