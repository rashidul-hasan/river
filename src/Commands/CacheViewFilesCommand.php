<?php

namespace Rashidul\River\Commands;

use Illuminate\Console\Command;
use Rashidul\River\Models\TemplatePage;

class CacheViewFilesCommand extends Command
{
    public $signature = 'river:cache-views';

    public $description = 'My command';

    const VIEW_DIR = 'resources/views/_cache';

    public function handle()
    {
        $this->ensureViewDirExists();

        $this->writeLayoutFiles();

    }

    private function ensureViewDirExists()
    {
        $dir = base_path(self::VIEW_DIR);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true); //TODO refcator to proper permissions
        }
        $dir = base_path(self::VIEW_DIR . '/layouts');
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true); //TODO refcator to proper permissions
        }
    }

    private function writeLayoutFiles()
    {
        $files = TemplatePage::type(TemplatePage::TYPE_LAYOUT)
            ->get();
        foreach ($files as $file) {
            $filename = self::VIEW_DIR . $file->filename;
            file_put_contents(base_path($filename), $file->code);
        }
    }
}
