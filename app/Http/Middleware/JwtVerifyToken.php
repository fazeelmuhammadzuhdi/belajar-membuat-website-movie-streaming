<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Throwable;

class JwtVerifyToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $jwtKey = env('JWT_KEY');
        $key = $request->bearerToken();
        try {
            $token = JWT::decode($key, new Key($jwtKey, 'HS256'));

            $request->attributes->add([
                'user' => $token->user
            ]);
            return $next($request);
            // dd($token);
        } catch (BeforeValidException $e) {
            return response()->json(['messsage' => 'token is not valid yet'], 401);
        } catch (ExpiredException $e) {
            return response()->json(['messsage' => 'token expired']);
        } catch (SignatureInvalidException $e) {
            return response()->json(['messsage' => 'Invalid Token signature']);
        } catch (Throwable $e) {
            return response()->json(['messsage' => 'Unauthorized'], 401);
        }
    }
}
