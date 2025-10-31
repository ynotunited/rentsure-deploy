<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NINVerificationService
{
    /**
     * Verify NIN using mock API (replace with real NIMC API when available)
     * 
     * @param string $nin
     * @return array
     */
    public function verifyNIN($nin)
    {
        // Mock NIN verification - replace with real NIMC API
        // For now, we'll simulate verification based on NIN format
        
        if (strlen($nin) !== 11 || !is_numeric($nin)) {
            return [
                'success' => false,
                'message' => 'Invalid NIN format',
                'data' => null
            ];
        }

        // Mock verification logic
        $mockVerifiedNINs = [
            '12345678901', // Test NIN 1
            '98765432109', // Test NIN 2
            '11111111111', // Test NIN 3
        ];

        if (in_array($nin, $mockVerifiedNINs)) {
            return [
                'success' => true,
                'message' => 'NIN verified successfully',
                'data' => [
                    'nin' => $nin,
                    'verified' => true,
                    'verification_date' => now()->toDateString(),
                    'status' => 'verified'
                ]
            ];
        }

        // For demo purposes, accept any 11-digit NIN
        return [
            'success' => true,
            'message' => 'NIN format valid (Mock verification)',
            'data' => [
                'nin' => $nin,
                'verified' => true,
                'verification_date' => now()->toDateString(),
                'status' => 'mock_verified'
            ]
        ];
    }

    /**
     * Real NIMC API integration (when available)
     * 
     * @param string $nin
     * @return array
     */
    public function verifyNINWithNIMC($nin)
    {
        try {
            // This would be the real NIMC API call
            // $response = Http::withHeaders([
            //     'Authorization' => 'Bearer ' . config('services.nimc.api_key'),
            //     'Content-Type' => 'application/json',
            // ])->post('https://api.nimc.gov.ng/verify', [
            //     'nin' => $nin
            // ]);

            // For now, return mock response
            return $this->verifyNIN($nin);

        } catch (\Exception $e) {
            Log::error('NIN verification failed: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Verification service temporarily unavailable',
                'data' => null
            ];
        }
    }

    /**
     * Check if NIN is already registered
     * 
     * @param string $nin
     * @return bool
     */
    public function isNINRegistered($nin)
    {
        return \App\Models\User::where('nin', $nin)->exists();
    }
}
