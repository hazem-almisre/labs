<?php

namespace App\Http\Controllers\Flutter\Order;

use App\Models\OrderApi;
use Illuminate\Http\Request;
use App\Message\ResponseMessage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\FlutterAddOrderResquest;
use App\Http\Requests\FlutterGetOrderByStatusResquest;
use App\Http\Requests\FlutterOrderChangeStatusResquest;
use App\Models\Line;

class OrderUserController extends Controller
{
    public function store(FlutterAddOrderResquest $request)
    {
        try {
            DB::beginTransaction();
            $userId = auth()->id();
            $isFrequency=false;
            $numberCount=count($request['lines']);
            if ($numberCount>1) {
                $isFrequency=true;
            }
            $order=OrderApi::query()->create([
                'contactId'=>$request->contactId,
                'totalPrice'=>$request->totalPrice,
                'serviceName'=>$request->serviceName,
                'date'=>$request->date,
                'labId'=>$request->labId,
                'userId'=>$userId,
                'isFrequency'=>$isFrequency,
                'instructios'=>$request->contactId
            ]);
            for ($i=0; $i < $numberCount; $i++) {
                Line::query()->create([
                    'dateStart'=>$request['lines'][$i]['dateStart'],
                    'analysis'=>$request['lines'][$i]['analysis'],
                    'price'=>$request['lines'][$i]['price'],
                    'status'=>"prosessing",
                    'orderId'=>$order->orderId
                ]);
            }
            DB::commit();
            return parent::sendRespons(['result'=>$order->orderId],ResponseMessage::$registerNurseSuccessfullMessage);
        } catch (\Throwable $th) {
            DB::rollBack();
            return parent::sendError($th->getMessage(),parent::getPostionError(OrderUserController::class,19),500) ;
        }
    }


    public function getOrderByStatus(FlutterGetOrderByStatusResquest $request)
    {
        try{
        $userId = auth()->id();
        //$id = Auth::id();
         $orders = OrderApi::query()->where('userId','=', $userId)->where('status','=' , $request->status)->with('nurse')->with('lab')->paginate(10);
         return parent::sendRespons(['result'=>$orders],ResponseMessage::$registerNurseSuccessfullMessage);
        }
        catch (\Throwable $th) {
            return parent::sendError($th->getMessage(),parent::getPostionError(OrderUserController::class,35),500) ;
        }
    }

    public function changeOrderStatus(FlutterOrderChangeStatusResquest $request)
    {
        try{
         $order = OrderApi::query()->findOrFail($request->orderId);
         $order->status = ($request->status)?$order->status:$request->status;
         $order->save();
         return parent::sendRespons(['result'=>[]],ResponseMessage::$registerNurseSuccessfullMessage);
        }
        catch (\Throwable $th) {
            return parent::sendError($th->getMessage(),parent::getPostionError(OrderUserController::class,35),500) ;
        }
    }


}
