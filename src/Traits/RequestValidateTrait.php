<?php
/**
 * Created by PhpStorm.
 * User: hugo
 * Date: 21/10/2018
 * Time: 08:42 PM
 */

namespace ApiBase\Traits;

use ApiBase\Helpers\ResponseRequestValidate;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
trait RequestValidateTrait
{
    public function ValidateRequest(Request $request,$classRequest){
        $data = new ResponseRequestValidate();
        $oValidate = Validator::make($request->all(),$classRequest->rules(),$classRequest->messages());
        if ($oValidate->fails()) {
            $message = $oValidate->errors()->all();
            $data->message = $message;
            $data->validate = true;
            return $data;
        }
        $data->message = "";
        $data->validate = false;
        return $data;
    }
}
