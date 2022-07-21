<?php

namespace Rashidul\River\Commands\Generators;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use Rashidul\River\Services\DataTypeService;
use Rashidul\River\Utility\FormBuilder;

class MakeViewFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'river:make-view
                            {name : Slug of the data type.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new migration';

    protected $viewBase = 'resources/views/';

    public function handle()
    {
        $slug = $this->argument('name');
        $viewDir = $slug;
        $dataTypeService = new DataTypeService();
        $fields = $dataTypeService->getFields($slug);

        $createFileContent = $this->getCreateFileContent($fields, $slug);
        $dataGridContent = $this->getDataGridContent($fields, $slug);


        $this->makeViewDirectory($viewDir);

        $file = base_path($this->viewBase . $viewDir . '/form.blade.php');
        file_put_contents($file, $createFileContent);
        $file = base_path($this->viewBase . $viewDir . '/datagrid.blade.php');
        file_put_contents($file, $dataGridContent);

        $this->info('View files generated!');

    }

    private function getCreateFileContent(array $fieldsArr, array|string|null $slug)
    {
        $service = new FormBuilder();
        $fields = $service->start('', '')
            ->skipFormTag()
            ->addFields($fieldsArr)
            ->render();

        $stub = file_get_contents(__DIR__ .'/stubs/create.blade.stub');
        $stub = str_replace('{{action}}', "{{route('{$slug}.store')}}", $stub);
        $stub = str_replace('{{fields}}', $fields, $stub);

        return $stub;
    }

    private function getDataGridContent(array $fieldsArr, array|string|null $slug)
    {
        $service = new FormBuilder();
        /*$fields = $service->start('', '')
            ->skipFormTag()
            ->addFields($fieldsArr)
            ->render();*/

        $stub = file_get_contents(__DIR__ .'/stubs/datagrid.blade.stub');
        /*$stub = str_replace('{{action}}', "{{route('{$slug}.store')}}", $stub);
        $stub = str_replace('{{fields}}', $fields, $stub);*/

        return $stub;
    }

    private function makeViewDirectory($viewDir)
    {
        $dir = base_path($this->viewBase . $viewDir);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true); //TODO refcator to proper permissions
        }
        /*$dir = base_path(self::VIEW_DIR . '/layouts');
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true); //TODO refcator to proper permissions
        }*/
    }
}
