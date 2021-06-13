<?php


namespace App\Service;


use Symfony\Component\HttpFoundation\Response;

class ResponseService
{
    function responseCode($status_code, $message)
    {
        $response = new Response(
            json_encode([
                'status' => $status_code,
                'message' => $message
            ]),
            $status_code,
            ['Content-Type' => 'application/json']
        );
        return $response->send();
    }

}