<?php

namespace App\Http\Controllers\AdminPanel\Novelty;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoveltyController extends Controller
{
	/**
	 * Toggle the specified resource from storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function toggle(Request $request)
	{

		if ($request->checked) {
			$checked = 1;
		} else {
			$checked = 0;
		}

		$product = Product::find($request->id);
		$product->update(['novelty' => $checked]);

		return response(['data' => 'Успешно'], 200);
	}
}
