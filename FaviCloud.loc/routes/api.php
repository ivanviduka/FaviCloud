<?php

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('files/{id}', function($id) {
    $files = File::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
    return response($files, 200);
});
Route::get('files', function() {
    $files = File::all()->toJson(JSON_PRETTY_PRINT);
    return response($files, 200);
});

Route::get('user-files/{user_id}', function($user_id) {
    $files = File::where('user_id', $user_id)->get()->toJson(JSON_PRETTY_PRINT);
    return response($files, 200);
});


