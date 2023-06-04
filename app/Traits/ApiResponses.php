<?php
/*
 * Made With ♥ By Mohamed Said
 * GitHub: https://github.com/EGYWEB-Mohamed
 * Email: me@msaied.com
 * Website: https://msaied.com/
 */

namespace App\Traits;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

trait ApiResponses
{
    public function sendSuccess($message, $data = [], $status = 200): Response|Application|ResponseFactory
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];
        if (! $message) {
            unset($response['message']);
        }

        return response($response, $status);
    }

    public function sendError($message, $data = [], $status = 422): Response|Application|ResponseFactory
    {
        $response = [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];
        if (! $message) {
            unset($response['message']);
        }
        if (! $data or empty($data)) {
            unset($response['data']);
        }

        return response($response, $status);
    }
}
