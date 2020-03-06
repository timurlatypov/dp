<?php

namespace App\Http\Controllers\API\V1;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Fomvasss\Dadata\Facades\DadataSuggest;

class SearchController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getDadata(Request $request)
    {
        $data = [];

        try {
            $result = DadataSuggest::suggest("address", [
                "query" => $request->get('keyword'),
                "count" => 5,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                'No results',
                200);
        }

        if (!is_array(array_values($result)[0])) {
            $data[] = $result;
        } else {
            $data = $result;
        }

        return response()->json([
            "data" => $data,
        ], 200);
    }

    public function getCDEKPrices(Request $request)
    {
        try {
            $receiverCityId = DadataSuggest::cityById($request->id);
        } catch (\Exception $e) {
            return;
        }
        $receiverCityId = $receiverCityId["data"]["cdek_id"];

        $authLogin    = config('cdek.authLogin');
        $authPassword = config('cdek.secure');
        $dateExecute  = date('Y-m-d');

        $secure = md5($dateExecute . "&" . $authPassword);

        $response = $this->client->post('https://api.cdek.ru/calculator/calculate_tarifflist.php',
            [
                'json' => [
                    'version'        => '1.0',
                    "authLogin"      => $authLogin,
                    "secure"         => $secure,
                    "dateExecute"    => $dateExecute,
                    "senderCityId"   => "44",
                    "receiverCityId" => $receiverCityId,
                    "currency"       => "RUB",
                    "goods"          => [
                        [
                            "weight" => "0.2",
                            "length" => "5",
                            "width"  => "5",
                            "height" => "5",

                        ],
                    ],
                    "tariffList"     => [
                        [
                            "id" => "136",
                        ],
                        [
                            "id" => "137",
                        ],
                    ],
                ],
            ],
            [
                "headers" => [
                    "Content-Type" => "application/json",
                    "Accept"       => "application/json",
                ],
            ]);

        return response()->json(
            json_decode($response->getBody()->getContents()),200
        );
    }
}
