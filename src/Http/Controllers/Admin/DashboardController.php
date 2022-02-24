<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
          'title' => 'Dashboard',
        ];

        return view('river::admin.dashboard.index', $data);
    }
}
