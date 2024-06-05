<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;


class DashboardController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Dashboard',
        ];

        return view('river::admin.dashboard.index', $data);
    }

    public function writer(){
        return "ok";
    }
}
