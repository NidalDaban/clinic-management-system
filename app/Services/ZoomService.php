<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZoomService
{
    protected $apiKey;
    protected $apiSecret;
    protected $accountId;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey     = config('services.zoom.client_id');
        $this->apiSecret  = config('services.zoom.client_secret');
        $this->accountId  = config('services.zoom.account_id');
        $this->baseUrl    = rtrim(config('services.zoom.base_url'), '/');
    }

    public function getAccessToken()
    {
        $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
            ->asForm()
            ->post('https://zoom.us/oauth/token', [
                'grant_type'  => 'account_credentials',
                'account_id'  => $this->accountId,
            ]);

        logger()->info('Zoom Token Response', [
            'status' => $response->status(),
            'body'   => $response->json(),
        ]);

        if (!$response->successful()) {
            Log::error('Failed to get Zoom access token', [
                'status' => $response->status(),
                'error'  => $response->body(),
            ]);
            return null;
        }

        return $response->json('access_token');
    }

    public function createMeeting($topic, $startTime, $duration = 30)
    {
        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            Log::error('Zoom access token is null.');
            return null;
        }

        $userId = $this->getUserId();
        $url = "{$this->baseUrl}/users/{$userId}/meetings";

        logger()->info('Zoom API Request Details', [
            'url'           => $url,
            'access_token'  => $accessToken,
        ]);

        $response = Http::withToken($accessToken)->post($url, [
            'topic'      => $topic,
            'type'       => 2,
            'start_time' => $startTime,
            'duration'   => $duration,
            'timezone'   => 'Asia/Amman',
            'settings'   => [
                'join_before_host'   => true,
                'host_video'         => true,
                'participant_video'  => true,
                'waiting_room'       => false,
            ],
        ]);

        logger()->info('Zoom Create Meeting Response', [
            'status' => $response->status(),
            'body'   => $response->json(),
        ]);

        if (!$response->successful()) {
            logger()->error('Zoom Create Meeting failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return null;
        }

        return $response->json();
    }

    protected function getUserId()
    {
        return 'nidaldaban7@gmail.com';
    }
}
