<?php

use App\Http\Controllers\Web\Analysis\AnalysisLabController;
use App\Http\Controllers\Web\Lab\AdminLabController;
use App\Http\Controllers\Web\Lab\AdminRegionController;
use Illuminate\Support\Facades\Route;  //--Eita dile ar "route" er niche error er red-wave ta r show kore na.

// use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//===================//=================//=================//==================//=================//=========





//---------------------For_JWT-------------------------
Route::group(['prefix'=>'admin','middleware'=>'auth:api'],function () {
    Route::get('get/regions', [AdminLabController::class,'getRegions']);
    Route::post('add/lab', [AdminLabController::class,'addLab']);
    Route::get('get/labs', [AdminLabController::class,'index']);
    Route::post('changeActivie/{labId}', [AdminLabController::class,'changeActivie']);
    Route::delete('delete/{labId}', [AdminLabController::class,'destroy']);
});

Route::group(['prefix'=>'region','middleware'=>'auth:api'],function () {
    Route::get('get', [AdminRegionController::class,'getRegions']);
    Route::post('add', [AdminRegionController::class,'addRegion']);
    // Route::get('get/nurses', [AdminRegionController::class,'index']);
    // Route::post('changeActivie/nurse/{nurseId}', [AdminRegionController::class,'changeActivie']);
    // Route::delete('delete/nurse/{nurseId}', [AdminRegionController::class,'destroy']);
});

Route::group(['prefix'=>'analysis','middleware'=>'auth:lab'],function () {
    // Route::get('get', [AdminLabController::class,'getRegions']);
    Route::post('add', [AnalysisLabController::class,'store']);
    Route::get('get/analyses', [AnalysisLabController::class,'index']);
    Route::delete('delete/{analysisId}', [AnalysisLabController::class,'destroy']);
});
