<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NINVerificationService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NINController extends Controller
{
    protected $ninService;

    public function __construct(NINVerificationService $ninService)
    {
        $this->ninService = $ninService;
    }

    /**
     * Verify NIN in real-time during registration
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function verify(Request $request): JsonResponse
    {
        $request->validate([
            'nin' => 'required|string|size:11'
        ]);

        $nin = $request->input('nin');

        // Check if NIN is already registered
        if ($this->ninService->isNINRegistered($nin)) {
            return response()->json([
                'success' => false,
                'message' => 'This NIN is already registered with another account',
                'data' => null
            ], 409);
        }

        // Verify NIN with mock API
        $verification = $this->ninService->verifyNIN($nin);

        return response()->json($verification);
    }

    /**
     * Get verification status for a NIN
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function status(Request $request): JsonResponse
    {
        $request->validate([
            'nin' => 'required|string|size:11'
        ]);

        $nin = $request->input('nin');
        
        $isRegistered = $this->ninService->isNINRegistered($nin);
        
        return response()->json([
            'nin' => $nin,
            'is_registered' => $isRegistered,
            'available' => !$isRegistered
        ]);
    }
}
