<?php

namespace App\Http\Controllers\AdminPanel\Line;

use App\Models\Line;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class LineController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @return Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show_all_lines_for_brand(Request $request)
    {
        $lines = Line::where('brand_id', $request->id)->select('id', 'name')->get();
        return response(['data' => $lines], 200);

    }
}
