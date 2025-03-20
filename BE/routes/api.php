<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::resource('register', UserController::class);
Route::post('logout', function (Request $request) {
    $accesstoken = $request->user()->token();
    $accesstoken->revoke();
    DB::table('oauth_refresh_tokens')->where('access_token_id', $accesstoken->id)->update(['revoked' => true]);
    return response()->json(['message' => 'Logout successful'], 200);
});
