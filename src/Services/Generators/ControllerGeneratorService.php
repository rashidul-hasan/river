<?php

namespace Rashidul\River\Services\Generators;

use Rashidul\River\Constants;
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

        //image
        $image_inputs = '';
        $fields = $type->fields;
        foreach ($fields as $field) {
            if ($field->type == Constants::FIELD_TYPE_IMAGE) {
                $image_inputs .= "'{$field->slug}',";
            }
        }
        $image_inputs = rtrim($image_inputs, ',');
        $stub = str_replace('{{image_inputs_arr}}', $image_inputs, $stub);

        $stub = str_replace('{{modelName}}', $type->singular, $stub);
        $stub = str_replace('DummyClass', $classname, $stub);
        $stub = str_replace('{{slug}}', $type->slug, $stub);

        return [$filename, $stub];
    }
}
