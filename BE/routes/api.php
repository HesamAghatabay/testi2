<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Nette\Utils\Random;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::resource('register', UserController::class);
Route::middleware('auth:api')->resource('profile', ProfileController::class);
Route::post('/sendVerify', function (Request $request) {
    $code = rand(1000, 9999);
    if ($user = User::where('mobile', $request->username)->first()) {
        $user->password = $code;
        $user->save();
        return response()->json(['status' => true, 'message' => 'user already exist']);
    } else {
        $user = User::create([
            'name' => '',
            'email' => '',
            'mobile' => $request->username,
            'password' => $code,
        ]);
    }
    $user->sendVerifyCode($code);
    if ($user->sendVerifyCode($code, $request->username)) {
        return response()->json(['status' => true], 200);
    } else {
        return response()->json(['status' => false, 'message' => 'sms faild'], 400);
    }
});




Route::post('logout', function (Request $request) {
    $accesstoken = $request->user()->token();
    $accesstoken->revoke();
    DB::table('oauth_refresh_tokens')->where('access_token_id', $accesstoken->id)->update(['revoked' => true]);
    return response()->json(['message' => 'Logout successful'], 200);
});
