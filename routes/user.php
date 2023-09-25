<?php

use App\Http\Controllers\Flutter\Lab\UserLabController;
use App\Http\Controllers\Flutter\User\UserAuthController;
use Illuminate\Support\Facades\Route;  //--Eita dile ar "route" er niche error er red-wave ta r show kore na.

// use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//===================//=================//=================//==================//=================//=========



//---------------------For_JWT-------------------------

Route::group(['prefix'=>'mobile'],function () {
    Route::post('register', [UserAuthController::class,'register']);

    Route::get('/isUser/{phone}',[UserAuthController::class,'isUser']);

    Route::post('login',[UserAuthController::class,'login']);
});


Route::group(['prefix'=>'labs' , 'middleware'=>'auth:api'],function () {
    Route::get('/getByRegion/{region}',[UserLabController::class,'getLabsByRegion']);

    Route::get('getAll',[UserLabController::class,'getLabs']);

    Route::get('searchByName/{labName}',[UserLabController::class,'searchByName']);

    Route::get('getLabsWithDistinct',[UserLabController::class,'getLabsWithDistinct']);

});
