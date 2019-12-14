<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;

class IntermezzoController extends Controller
{
    public function __invoke($date)
    {
        $client = new Client();
        $dates = today()->format('m/d');

        switch ($date) {
            case 'today' :
                $dates = today('Asia/Jakarta')->format('m/d');
                break;
            case 'yesterday':
                $dates = Carbon::yesterday('Asia/Jakarta')->format('m/d');
                break;
            case 'tomorrow':
                $dates = Carbon::tomorrow('Asia/Jakarta')->format('m/d');
                break;
            default:
                return $this->error('The Value Only Acceptable today, yesterday, or tomorrow', 422);
        }

        $client = $client->get(env('API_NUMBER_URL') . $dates . '/date?json');

        $response = json_decode($client->getBody(), true);

        return [
            'data' => [
                'text' => $response['text'],
                'year' => $response['year']
            ],
            'meta' => [
                'http_status' => $client->getStatusCode()
            ]
        ];
    }
}
