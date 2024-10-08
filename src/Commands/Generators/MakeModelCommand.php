<?php

namespace BitPixel\SpringCms\Commands\Generators;

use Illuminate\Console\GeneratorCommand;

class MakeModelCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'river:make-model
                            {name : The name of the model.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new model';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Fields that need to casted to native types
     * @var array
     */
    protected $casts = [];


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('raindrops.crud.generator.custom_template')
            ? config('raindrops.crud.generator.stubs') . '/model.stub'
            : __DIR__ . './stubs/model.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return "App\\Models";
    }

    /**
     * Build the model class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function buildClass($entity)
    {
        $stub = $this->files->get($this->getStub());

        $ret = $this->replaceNamespace($stub, $entity);

        return $ret->replaceClass($stub, $entity);
    }
}
