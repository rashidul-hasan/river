<?php

namespace BitPixel\SpringCms\Commands\Generators;

use Illuminate\Console\GeneratorCommand;
use BitPixel\SpringCms\Models\DataType;

class MakeControllerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'river:make-controller
                            {name : The name of the controller.}
                            {--slug= : slug of type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new resource controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('raindrops.crud.generator.custom_template')
            ? config('raindrops.crud.generator.stubs') . '/controller.stub'
            : __DIR__ . './stubs/controller.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     *
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\' . 'Http\Controllers';
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        /*if ($this->option('force')) {
            return false;
        }
        return parent::alreadyExists($rawName);*/
        return false; //TODO maybe later
    }

    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($name)
    {
        $slug = $this->option('slug');
        $type = DataType::slug($slug)
            ->first();
        if ($type === null) {
            $this->warn('Type not found');
            return;
        }
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)
            ->replaceModelName($stub, $type->singular)
            ->replaceSlug($stub, $slug)
            ->replaceClass($stub, $name);
    }


    /**
     * Replace the modelName for the given stub.
     *
     * @param  string  $stub
     * @param  string  $modelName
     *
     * @return $this
     */
    protected function replaceModelName(&$stub, $modelName)
    {
        $stub = str_replace(
            '{{modelName}}', $modelName, $stub
        );

        return $this;
    }

    protected function replaceSlug(&$stub, $slug)
    {
        $stub = str_replace(
            '{{slug}}', $slug, $stub
        );

        return $this;
    }

    /**
     * Replace the validationRules for the given stub.
     *
     * @param  string  $stub
     * @param  string  $validationRules
     *
     * @return $this
     */
    protected function replaceValidationRules(&$stub, $validationRules)
    {
        $stub = str_replace(
            '{{validationRules}}', $validationRules, $stub
        );

        return $this;
    }

    /**
     * Replace the pagination placeholder for the given stub
     *
     * @param $stub
     * @param $perPage
     *
     * @return $this
     */
    protected function replacePaginationNumber(&$stub, $perPage)
    {
        $stub = str_replace(
            '{{pagination}}', $perPage, $stub
        );

        return $this;
    }

    /**
     * Replace the file snippet for the given stub
     *
     * @param $stub
     * @param $fileSnippet
     *
     * @return $this
     */
    protected function replaceFileSnippet(&$stub, $fileSnippet)
    {
        $stub = str_replace(
            '{{fileSnippet}}', $fileSnippet, $stub
        );

        return $this;
    }

    /**
     * Replace the where snippet for the given stub
     *
     * @param $stub
     * @param $whereSnippet
     *
     * @return $this
     */
    protected function replaceWhereSnippet(&$stub, $whereSnippet)
    {
        $stub = str_replace(
            '{{whereSnippet}}', $whereSnippet, $stub
        );

        return $this;
    }
}
