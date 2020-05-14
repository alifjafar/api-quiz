<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ErrorResponse;
use App\Http\Controllers\Controller;
use App\Resources\BaseResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class IntermezzoController extends Controller
{
    /**
     * @param $date
     * @return JsonResponse
     */
    public function __invoke($date)
    {
        switch ($date) {
            case 'today' :
                $dates = today()->format('m/d');
                break;
            case 'yesterday':
                $dates = Carbon::yesterday()->format('m/d');
                break;
            case 'tomorrow':
                $dates = Carbon::tomorrow()->format('m/d');
                break;
            default:
                return (new ErrorResponse)->errorResponse(
                    'The Value Only Acceptable today, yesterday, or tomorrow',
                    422
                );
        }

        $client = Http::get(env('API_NUMBER_URL') . $dates . '/date?json');

        $response = $client->json();

        return (new BaseResponse)
                ->setData([
                    'text' => $response['text'],
                    'year' => $response['year']
                ])
                ->setStatus($client->status())
                ->build();
    }
}
