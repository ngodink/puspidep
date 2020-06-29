<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as AppController;

class Controller extends AppController
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
    	$user = auth()->user();

        return view('account::index', compact('user'));
    }
}
