<?php

namespace App\Http\Controllers\API\V1;

use App\Services\Dadata\Response\ClientSuggest;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    protected Client $client;
    protected ClientSuggest $suggest;

    public function __construct()
    {
        $this->client = new Client();
        $this->suggest = new ClientSuggest();
    }

    public function getDadata(Request $request)
    {
        $data = [];

        try {
            $result = $this->suggest->suggest("address", [
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
            $receiverCityId = $this->suggest->cityById($request->id);
        } catch (\Exception $e) {
            return $e->getMessage();
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
