<?php

namespace Rashidul\River\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
          'title' => 'Homepage',
        ];

//        return view('river::Commands.templates.home', $data);
    }
}
