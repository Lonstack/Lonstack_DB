<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $apiKey  = config('services.brevo.key');
        $listId  = (int) config('services.brevo.newsletter_list');

        // Guard: fail early if config is missing
        if (!$apiKey || !$listId) {
            Log::error('Brevo newsletter config missing', [
                'key_set'  => !empty($apiKey),
                'list_id'  => $listId,
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Newsletter service is not configured.',
            ], 500);
        }

        $response = Http::withHeaders([
            'accept'       => 'application/json',
            'api-key'      => $apiKey,
            'content-type' => 'application/json',
        ])->post('https://api.brevo.com/v3/contacts', [
            'email'         => $request->email,
            'listIds'       => [$listId],
            'updateEnabled' => true,
        ]);

        $body       = $response->json();
        $statusCode = $response->status();

        Log::info('Brevo subscribe response', [
            'email'  => $request->email,
            'status' => $statusCode,
            'body'   => $body,
        ]);

        // 201 = created, 204 = updated (already existed + updateEnabled)
        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => '🎉 Thanks for subscribing!',
            ]);
        }

        // Brevo returns 400 with code "duplicate_parameter" when already subscribed
        // (only if updateEnabled is false — with updateEnabled:true it returns 204)
        if (isset($body['code']) && $body['code'] === 'duplicate_parameter') {
            return response()->json([
                'success' => true,
                'message' => '✅ You are already subscribed.',
            ]);
        }

        // Surface the actual Brevo error message in the response
        $brevoMessage = $body['message'] ?? 'Subscription failed. Please try again.';

        Log::error('Brevo subscribe failed', [
            'email'   => $request->email,
            'status'  => $statusCode,
            'code'    => $body['code']    ?? null,
            'message' => $brevoMessage,
        ]);

        return response()->json([
            'success' => false,
            'message' => $brevoMessage,
        ], 422);
    }
}
