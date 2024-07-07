<?php

namespace App\Http\Controllers\AdminPanel\Design;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DesignController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.design.index');
    }
}
