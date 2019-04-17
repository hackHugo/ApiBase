<?php
namespace fmelchor\apibase\utils;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use App\User;
use Illuminate\Support\Facades\Config;
class Token
{
    public static function tonkenEncode(User $usuario){
        $key = Config::get('app.jwtKey');
        $token = array(
            "nombre" => $usuario->nombre,
            "email" => $usuario->email,
            "fecha" => Carbon::now()->toDateTimeString()
        );

        $jwt = JWT::encode($token,$key);
        return $jwt;

    }
    public static function tokenDecode($jwt){
        $key = Config::get('app.jwtKey');
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        return $decoded;
    }
}
