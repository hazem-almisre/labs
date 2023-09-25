<?php

use App\Http\Controllers\Web\NurseController;
use Illuminate\Support\Facades\Route;  //--Eita dile ar "route" er niche error er red-wave ta r show kore na.

// use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//===================//=================//=================//==================//=================//=========



//---------------------For_JWT-------------------------

Route::group(['prefix'=>'web','middleware'=>'auth:api'],function () {
    Route::post('add/nurse', [NurseController::class,'addNurse']);
    Route::get('get/nurses', [NurseController::class,'index']);
    Route::post('changeActivie/nurse/{nurseId}', [NurseController::class,'changeActivie']);
    Route::delete('delete/nurse/{nurseId}', [NurseController::class,'destroy']);
    Route::get('get/regions', [NurseController::class,'getRegions']);
});
