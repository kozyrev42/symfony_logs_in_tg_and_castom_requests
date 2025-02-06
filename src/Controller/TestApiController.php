<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class TestApiController
{
    public function test(): Response
    {
        $data = [
            'message' => 'Test API. Project: {symfony_logs_in_tg_and_castom_requests}',
            'time' => date('Y-m-d H:i:s')
        ];

        return new Response(json_encode($data), 200, ['Content-Type' => 'application/json']);
    }
}
