<?php

namespace Rashidul\River\Commands\Generators;

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
     * A handy helper class to make some stuffs easy
     * @var Helper
     */
    protected $helper;

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

    /**
     * Replace the table for the given stub.
     *
     * @param  string  $stub
     * @param  string  $table
     *
     * @return $this
     */
    protected function replaceTable(&$stub, $table)
    {
        $stub = str_replace(
            '{{table}}', $table, $stub
        );

        return $this;
    }

    protected function replaceFields(&$stub, $fields)
    {
       // $file = file_put_contents(__DIR__ . '/../stubs/fields.stub', var_export($fields, true));
//        $fields = file_get_contents(__DIR__ . '/../stubs/fields.stub');
        $helper =  new Helper();
        $fields = $helper->arrayAsString($fields);
        $stub = str_replace('{{fields}}', $fields, $stub);
        return $this;
    }
}
