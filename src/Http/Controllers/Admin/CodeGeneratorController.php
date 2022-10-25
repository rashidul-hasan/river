<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Rashidul\River\Services\Generators\ControllerGeneratorService;
use Rashidul\River\Services\Generators\MigrationGeneratorService;

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
