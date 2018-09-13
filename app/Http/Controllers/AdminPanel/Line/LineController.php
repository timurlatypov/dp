<?php

namespace App\Http\Controllers\AdminPanel\Line;

use App\Line;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LineController extends Controller
{
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show_all_lines_for_brand(Request $request)
	{
		$lines = Line::where('brand_id', $request->id)->select('id', 'name')->get();
		return response(['data' => $lines], 200);

	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
