<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use BitPixel\SpringCms\Services\Generators\ControllerGeneratorService;
use BitPixel\SpringCms\Services\Generators\MigrationGeneratorService;

class CodeGeneratorController extends Controller
{


    public function index()
    {
        $data = [
          'title' => 'Dashboard',
        ];

//        list($filename, $code) = ControllerGeneratorService::getGenericControllerCode('customers');
        list($filename, $code) = MigrationGeneratorService::getMigrationCode('customers');

        return response()->streamDownload(function () use ($code) {
            echo $code;
        }, $filename);

//        return view('river::admin.dashboard.index', $data);
    }
}
