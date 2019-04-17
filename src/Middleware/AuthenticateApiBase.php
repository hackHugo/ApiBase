<?php
/**
 * Created by PhpStorm.
 * User: administrador
 * Date: 17/04/19
 * Time: 10:13 AM
 */
namespace fmelchor\apibase\Middleware;
use fmelchor\apibase\utils\Token;
use Closure;
use Carbon\Carbon;
use fmelchor\apibase\Traits\ReplyTrait;
use fmelchor\apibase\Responses\Responses;
class AuthenticateApiBase
{
    use ReplyTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $oResponse = new Responses();
        $tokenUser = $request->header('Authorization');
        if ($tokenUser == null) {
            $oResponse->status = 0;
            $oResponse->message = "El token es requerido";
            return $this->Unauthorized($oResponse);
        }
        $user = User::where('Token', '=', $tokenUser)->get()->first();
        if ($user == null) {
            $oResponse->status = 0;
            $oResponse->message = "No tienes permiso para este recurso";
            return $this->Unauthorized($oResponse);
        }
        //para checar la cadusidad del token
       $tokenEncode = Token::tokenDecode($tokenUser);
        $dt = new \DateTime($tokenEncode->fecha);
        $carbon = Carbon::instance($dt);
        if ($carbon->diffInHours(Carbon::now()) >= 1) {
            $user->token = "";
            $user->save();
            $oResponse->status = 0;
            $oResponse->message =  "el token a caducado";
            return $this->Unauthorized($oResponse);
        }
        return $next($request);
    }
}
