<?php

namespace Rashidul\River\Services\Generators;

use Rashidul\River\Constants;
use Rashidul\River\Models\DataType;

class MigrationGeneratorService
{

    public static function getMigrationCode($typeSlug)
    {
        $type = DataType::slug($typeSlug)
            ->with('fields')
            ->first();

        $filename = "2019_08_19_000000_create_{$type->slug}_table.php";

        $stub = file_get_contents(__DIR__ . './stubs/migration.stub');

        $stub = str_replace('{{table}}', $type->slug, $stub);

        $map = [
            Constants::FIELD_TYPE_PHONE => 'string',
            Constants::FIELD_TYPE_TEXT => 'string',
            Constants::FIELD_TYPE_IMAGE => 'string',
        ];


        //columns
        $columns = '';
        $fields = $type->fields;
        foreach ($fields as $field) {
            $column_type = $map[$field->type];

            $columns .= '$table->'.$column_type.'(\''.$field->slug.'\');' . "\n";
        }


        $stub = str_replace('{{columns}}', $columns, $stub);


        return [$filename, $stub];
    }
}
