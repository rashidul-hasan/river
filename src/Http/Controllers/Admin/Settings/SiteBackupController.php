<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use File;
use Ifsnop\Mysqldump\Mysqldump;
use BitPixel\SpringCms\Services\SettingsService;
use ZipArchive;

class SiteBackupController extends Controller
{
    public function index()
    {
        $data = [
            'settings' => SettingsService::getSettingsArray(),
        ];

        return view('river::admin.settings.site_backup.index', $data);

    }

    public function backup_store(){
        // Get database credentials from the .env file
        $dbHost = config('database.connections.mysql.host');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        $currentDate = Carbon::now()->format('d-m-Y');

        // Create a temporary directory for storing backup files
        $tempDir = storage_path('app/temp_backup');
        File::makeDirectory($tempDir, 0755, true, true);

        // Dump the database to an SQL file using mysqldump-php
        $sqlFilePath = $tempDir . '/database2.sql';
        $dump = new Mysqldump("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass);
        $dump->start($sqlFilePath);



        // Create a zip file
        $zip = new ZipArchive;
        $zipFileName = $currentDate . '.zip';

        $zipFilePath = storage_path('app/' . $zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            // Add the SQL file to the zip
            $zip->addFile($sqlFilePath, 'database.sql');

            $publicDirectory = public_path('river/assets');
            $this->addFilesToZip($publicDirectory, $zip, 'river/assets');


            $zip->close();

            // Delete the temporary directory after creating the zip
            File::deleteDirectory($tempDir);

            // Download the zip file
            return response()->download($zipFilePath)->deleteFileAfterSend();
        } else {
            return 'Unable to create the zip file.';
        }
    }

    private function addFilesToZip($dir, $zip, $relativePath = '')
    {
        $files = File::allFiles($dir);

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $relativeFilePath = $relativePath . '/' . $file->getRelativePathname();

            $zip->addFile($filePath, $relativeFilePath);
        }
    }

}
