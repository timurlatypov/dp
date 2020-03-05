<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Fomvasss\Dadata\Facades\DadataSuggest;

class SearchController extends Controller
{
    public function getDadata(Request $request)
    {
        $result = DadataSuggest::suggest("address", [
            "query" => $request->get('keyword'),
            "count" => 5,
        ]);

        return response()->json([
            "data" => $result,
        ], 200);
    }
}
