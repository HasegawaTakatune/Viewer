<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

// https://blog.fox-hound.tech/1295/
// https://www.mgo-tec.com/blog-entry-ngrok-install.html
Route::put('set-detection', function(Request $request ){
    info($request->all());
    if($request->has('data')){
        Storage::put('public/data.txt', $request->data, 'public');
    }

    return response()->json(['request' => $request->all(), 'data' => $request->data, 'path' => Storage::url('public/detection.txt')]);
});

Route::get('get-detection', function(Request $request) {
    return response()->json([Storage::get('public/data.txt')]);
});