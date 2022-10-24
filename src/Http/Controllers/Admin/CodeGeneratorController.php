<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Rashidul\River\Services\Generators\ControllerGeneratorService;

class CodeGeneratorController extends Controller
{
    public function index()
    {
        $data = [
          'title' => 'Dashboard',
        ];

        list($filename, $code) = ControllerGeneratorService::getGenericControllerCode('customers');

        return response()->streamDownload(function () use ($code) {
            echo $code;
        }, $filename);

//        return view('river::admin.dashboard.index', $data);
    }
}
