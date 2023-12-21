<?php

namespace Rashidul\River\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rashidul\River\Services\SettingsService;

class SiteBackupController extends Controller
{
    public function index()
    {
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];

        return "Site Backup Controller add in ... Controllers/Admin/Settings/SiteBackupController ";
        
    }

}
