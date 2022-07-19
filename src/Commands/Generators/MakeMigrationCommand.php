<?php

namespace Rashidul\River\Commands\Generators;

use Illuminate\Console\GeneratorCommand;
use Rashidul\River\Services\DataTypeService;

class MakeMigrationCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'river:migration
                            {name : Slug of the data type.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new migration';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migration';

    /**
     *  Migration column types collection.
     *
     * @var array
     */
    protected $typeLookup = [
        \Rashidul\River\Constants::FIELD_TYPE_TEXT => 'string',
        \Rashidul\River\Constants::FIELD_TYPE_CHECKBOX => 'boolean',
        \Rashidul\River\Constants::FIELD_TYPE_DATE => 'date',
        \Rashidul\River\Constants::FIELD_TYPE_EMAIL => 'string',
        \Rashidul\River\Constants::FIELD_TYPE_PHONE => 'string',
        \Rashidul\River\Constants::FIELD_TYPE_IMAGE => 'string',
        \Rashidul\River\Constants::FIELD_TYPE_TEXTAREA => 'text',
        \Rashidul\River\Constants::FIELD_TYPE_PASSWORD => 'string',
        /*'datetime' => 'dateTime',
        'time' => 'time',
        'text' => 'string',
        'textarea' => 'mediumText',
        'richtext' => 'longText',
        'jsonb' => 'jsonb',
        'binary' => 'binary',
        'number' => 'integer',
        'integer' => 'integer',
        'bigint' => 'bigInteger',
        'mediumint' => 'mediumInteger',
        'tinyint' => 'tinyInteger',
        'smallint' => 'smallInteger',
        'boolean' => 'boolean',
        'decimal' => 'decimal',
        'double' => 'double',
        'float' => 'float',

        // custom
        'checkbox' => 'boolean',
        'image' => 'string',
        'currency' => 'decimal',
        'select' => 'enum',*/

    ];


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return config('raindrops.crud.generator.custom_template')
        ? config('raindrops.crud.generator.stubs') . '/migration.stub'
        : __DIR__ . '/stubs/migration.stub';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     *
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);
        $datePrefix = date('Y_m_d_His');
        return database_path('/migrations/') . $datePrefix . '_create_' . $name . '_table.php';
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
        $stub = $this->files->get($this->getStub());

        $slug = $this->argument('name');
        $tableName = $slug;
        $dataTypeService = new DataTypeService();
        $fields = $dataTypeService->getFields($slug);
//        dd($fields);


        $tabIndent = '    ';

        $schemaFields = '';
        foreach ($fields as $name => $options) {
            if (isset($this->typeLookup[$options['type']]))
            {

                // for select type, there should be a 3rd array item called options
                // build an array for enum options
                /*if ($item['type'] === 'select')
                {
                    $type = $this->typeLookup[$item['type']];
                    $optionsArray = '';
                    if (isset($item['options']) )
                    {
                        $optionsArray = $this->arrayToString($item['options']);
                    }
                    $schemaFields .= "\$table->" . $type . "('" . $item['name'] . "', ". $optionsArray .")->nullable()";
                }
                elseif ($item['type'] === 'currency')
                {
                    $type = $this->typeLookup[$item['type']];
                    $optionsArray = '';
                    if (isset($item['options']) )
                    {
                        $optionsArray = $this->arrayToString($item['options']);
                    }
                    $schemaFields .= "\$table->" . $type . "('" . $item['name'] . "', ". $item['options'][0] .", ". $item['options'][1] .")->nullable()";
                }*/
                /*else*/
                {
                    $type = $this->typeLookup[$options['type']];

                    $schemaFields .= "\$table->" . $type . "('" . $name . "')->nullable()";
                }

            }
            else
            {
                $schemaFields .= "\$table->string('" . $name . "')->nullable()";
            }



            // Append column modifier
            /*$schemaFields .= $item['modifier'];*/
            $schemaFields .= ";\n" . $tabIndent . $tabIndent . $tabIndent;
        }


        $schemaUp =
            "Schema::create('" . $tableName . "', function(Blueprint \$table) {
            \$table->increments('id');
            " . $schemaFields . "\$table->timestamps();
        });";

        $schemaDown = "Schema::drop('" . $tableName . "');";

        return $this->replaceSchemaUp($stub, $schemaUp)
            ->replaceSchemaDown($stub, $schemaDown)
            ->replaceClass($stub, '');
    }




    /**
     * Replace the schema_up for the given stub.
     *
     * @param  string  $stub
     * @param  string  $schemaUp
     *
     * @return $this
     */
    protected function replaceSchemaUp(&$stub, $schemaUp)
    {
        $stub = str_replace(
            '{{schema_up}}', $schemaUp, $stub
        );

        return $this;
    }

    /**
     * Replace the schema_down for the given stub.
     *
     * @param  string  $stub
     * @param  string  $schemaDown
     *
     * @return $this
     */
    protected function replaceSchemaDown(&$stub, $schemaDown)
    {
        $stub = str_replace(
            '{{schema_down}}', $schemaDown, $stub
        );

        return $this;
    }

    protected function arrayToString($explode)
    {
        $string = "[";
        foreach ($explode as $item)
        {
            $string .= "'$item',";
        }
        $string = rtrim($string, ',');

        return $string . ']';
    }
}
