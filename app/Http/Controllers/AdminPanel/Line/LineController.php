<?php

namespace App\Http\Controllers\AdminPanel\Line;

use App\Http\Controllers\Controller;
use App\Models\Line;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LineController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return Response|ResponseFactory
     */
    public function show_all_lines_for_brand(Request $request)
    {
        $lines = Line::where('brand_id', $request->id)->select('id', 'name')->get();

        return response(['data' => $lines], 200);
    }
}
