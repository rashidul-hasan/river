<?php

namespace Rashidul\River\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use File;
use Ifsnop\Mysqldump\Mysqldump;
use Rashidul\River\Services\SettingsService;


class CodeSnippetsController extends Controller
{
    public function index()
    {

        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];

        return view('river::admin.settings.code_snippet.index', $data);
    }
}
