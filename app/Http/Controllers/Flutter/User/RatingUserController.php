<?php

namespace App\Http\Controllers\Flutter\User;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Message\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlutterAddRatingResquest;

class RatingUserController extends Controller
{
    public function store(FlutterAddRatingResquest $request) {
        try {
            $userId = auth()->id();
            $request['userId'] = $userId;
            $rating=Rating::query()->create($request->all());
            return parent::sendRespons(['result'=>$rating],ResponseMessage::$registerNurseSuccessfullMessage);
        } catch (\Throwable $th) {
            return parent::sendError($th->getMessage(),parent::getPostionError(RatingUserController::class,20),500) ;
        }
    }
}
