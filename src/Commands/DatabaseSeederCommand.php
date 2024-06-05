<?php

namespace BitPixel\SpringCms\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use BitPixel\SpringCms\Models\TemplatePage;

class DatabaseSeederCommand extends Command
{
    public $signature = 'river:seed';

    public $description = 'Seed database';


    public function handle()
    {
        $this->seedAdminUsers();

        $this->seedTemplateFiles();

        $this->info('Done!');
    }

    private function seedAdminUsers()
    {
        //TODO check if data alreadu exists in db
        DB::table('river_admins')->insert([
            'role_id' => 1,
            'name' => 'Admin',
            'email'=>'admin@gmail.com',
            'password' => Hash::make('1234'),
            'is_developer' => 1
        ]);

        DB::table('river_roles')->insert([
            'id' => 1,
            'name' => 'Developer'
        ]);
    }

    private function seedTemplateFiles()
    {
        $path    = __DIR__ . '/templates';
        $files = array_diff(scandir($path), array('.', '..'));

        foreach ($files as $file) {
            $content = file_get_contents($path . '/' . $file);
            TemplatePage::create([
                'filename' => $file,
                'code' => $content
            ]);
        }
    }

}
