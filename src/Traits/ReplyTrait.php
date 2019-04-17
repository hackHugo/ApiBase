<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 20/10/2018
 * Time: 06:47 PM
 */

namespace fmelchor\apibase\Traits;


use fmelchor\apibase\Response\Responses;

trait ReplyTrait
{
    protected function Success(Responses $oResponse)
    {
        return response()->json(["message" => $oResponse->message, "status" => $oResponse->status, "data" => $oResponse->data], 200);
    }

    protected function BadRequest(Responses $oResponse)
    {
        return response()->json(["message" => $oResponse->message, "status" => $oResponse->status, "data" => $oResponse->data], 400);
    }

    protected function Unauthorized(Responses $oResponse)
    {
        return response()->json(["message" => $oResponse->message, "status" => $oResponse->status, "data" => $oResponse->data], 401);
    }
    protected function InternalServerError(Responses $oResponse,\Exception $ex)
    {
        return response()->json(["message" => $oResponse->message, "status" => $oResponse->status, "data" => ['linea:' => $ex->getLine(), 'file' => $ex->getFile(), 'mensaje' => $ex->getMessage()]], 500);
    }
    protected function Response(Responses $oResponse,$code)
    {
        return response()->json(["message" => $oResponse->message, "status" => $oResponse->status, "data" => $oResponse->data], $code);
    }
}
