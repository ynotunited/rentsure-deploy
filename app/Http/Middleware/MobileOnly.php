<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MobileOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the request is from a mobile device
        $isMobile = $this->isMobileDevice($request);
        
        // If it's not a mobile device and we're not already on the mobile-only page
        if (!$isMobile && !$request->is('mobile-only')) {
            return redirect()->route('mobile.only');
        }
        
        return $next($request);
    }
    
    /**
     * Check if the request is from a mobile device.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    private function isMobileDevice(Request $request)
    {
        $userAgent = $request->header('User-Agent');
        
        if (!$userAgent) {
            return false;
        }
        
        // Simple mobile device detection
        $mobileKeywords = [
            'Mobile', 'Android', 'iPhone', 'iPad', 'iPod', 'BlackBerry', 
            'Windows Phone', 'Opera Mini', 'IEMobile', 'Mobile Safari'
        ];
        
        foreach ($mobileKeywords as $keyword) {
            if (stripos($userAgent, $keyword) !== false) {
                return true;
            }
        }
        
        return false;
    }
}