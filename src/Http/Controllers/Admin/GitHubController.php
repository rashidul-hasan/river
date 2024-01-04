<?php

namespace Rashidul\River\Http\Controllers\Admin;

use CzProject\GitPhp\Git;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class GitHubController
{
    public function cloneGitHubRepo()
    {
        // GitHub repository URL (replace with your repository URL)
        $repoUrl = 'https://github.com/rashidul-hasan/river.git';
        $git = new Git;
        $repo = $git->open(base_path('package/river'));
        $repo->pull('origin');

        // Directory where the repository will be cloned (inside 'package/river')
        /*$clonePath = base_path('package/river');

        // Run 'git clone' command to clone the repository
        $command = "git clone --branch master --depth 1 {$repoUrl} {$clonePath}";
        exec($command, $output, $exitCode);
        // Check if the cloning was successful
        if ($exitCode === 0) {
            // Replace existing files with the new code
            $this->replaceFiles($clonePath, base_path());

            return response()->json(['message' => 'Repository cloned successfully.']);
        } else {
            return response()->json(['error' => 'Failed to clone repository.']);
        }*/

        return response()->json(['message' => 'Repository cloned successfully.']);

    }

    private function replaceFiles($sourceDir, $destinationDir)
    {
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourceDir, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($files as $file) {
            $filePath = $destinationDir . DIRECTORY_SEPARATOR . $files->getSubPathname();
            if ($file->isDir()) {
                if (!file_exists($filePath)) {
                    mkdir($filePath);
                }
            } else {
                copy($file, $filePath);
            }
        }
    }


    public function ClearCache(){
        Artisan::call('cache:clear');

        return redirect()->back()
            ->with('success', 'Cache cleared!');
    }
}
