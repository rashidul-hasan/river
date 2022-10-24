<?php

namespace Rashidul\River\Services\Generators;

use Rashidul\River\Models\DataType;

class ControllerGeneratorService
{

    public static function getGenericControllerCode($typeSlug)
    {
        $type = DataType::slug($typeSlug)
            ->with('fields')
            ->first();

        $classname = $type->singular . 'Controller';
        $filename = $type->singular . 'Controller.php';

        $stub = file_get_contents(__DIR__ . './stubs/controller-generic.stub');
        $stub = str_replace('{{modelName}}', $type->singular, $stub);
        $stub = str_replace('DummyClass', $classname, $stub);
        $stub = str_replace('{{slug}}', $type->slug, $stub);

        return [$filename, $stub];
    }
}
