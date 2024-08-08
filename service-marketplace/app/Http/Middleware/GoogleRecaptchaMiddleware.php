<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class GoogleRecaptchaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        if (!NoCaptcha::checkResponse($request->input('g-recaptcha-response'))) {
            return redirect()->back()->with('error', 'ReCAPTCHA verification failed.');
        }

        return $next($request);
    }
}
