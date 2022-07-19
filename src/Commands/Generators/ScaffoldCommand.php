<?php

namespace Rashidul\River\Commands\Generators;

use File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Rashidul\River\Models\DataType;
use Rashidul\River\Services\DataTypeService;

class ScaffoldCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'river:crud
                            {name : Slug of the data type.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic CRUD components';

    /** @var string  */
    protected $routeName = '';

    /** @var string  */
    protected $controller = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $slug = $this->argument('name');
        $type = DataType::slug($slug)
            ->first();
        if ($type === null) {
            $this->warn('Type not found');
            return;
        }

        $entitySingular = $type->singular;
        $viewDir = $slug;
        $dataTypeService = new DataTypeService();
        $fields = $dataTypeService->getFields($slug);


        $this->appendRoute($slug, $entitySingular);

        $this->call('river:make-view', ['name' => $slug]);
        $this->call('river:make-controller', ['name' => "{$entitySingular}Controller", '--slug' => $slug]);
        $this->call('river:make-model', ['name' => "{$entitySingular}"]);


        $this->info('You\'re Done! Yeee!');


    }

    protected function appendRoute($slug, $entitySingular)
    {
        // location of the routes file
        $routeFile = app_path('Http/routes.php');

        if (\App::VERSION() >= '5.3') {
            $routeFile = base_path('routes/web.php');
        }
        if (file_exists($routeFile)) {
            //$this->controller = ($controllerNamespace != '') ? $controllerNamespace . '\\' . $entity . 'Controller' : $entity . 'Controller';
            $this->controller = $entitySingular . 'Controller';

            $isAdded = File::append($routeFile, "\nRoute::resource('{$slug}', '{$entitySingular}Controller');" );

            /*if ($isAdded) {
                $this->info('Crud/Resource route added to ' . $routeFile);
            } else {
                $this->info('Unable to add the route to ' . $routeFile);
            }*/
        }
    }

    /**
     * Process the JSON Fields.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONFields($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        $fieldsString = '';
        foreach ($fields->fields as $field) {
            if ($field->type == 'select') {
                $fieldsString .= $field->name . '#' . $field->type . '#options=' . implode(',', $field->options) . ';';
            } else {
                $fieldsString .= $field->name . '#' . $field->type . ';';
            }
        }

        $fieldsString = rtrim($fieldsString, ';');

        return $fieldsString;
    }

    /**
     * Process the JSON Foreign keys.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONForeignKeys($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        if (! property_exists($fields, 'foreign_keys')) {
            return '';
        }

        $foreignKeysString = '';
        foreach ($fields->foreign_keys as $foreign_key) {
            $foreignKeysString .= $foreign_key->column . '#' . $foreign_key->references . '#' . $foreign_key->on;

            if (property_exists($foreign_key, 'onDelete')) {
                $foreignKeysString .= '#' . $foreign_key->onDelete;
            }

            if (property_exists($foreign_key, 'onUpdate')) {
                $foreignKeysString .= '#' . $foreign_key->onUpdate;
            }

            $foreignKeysString .= ',';
        }

        $foreignKeysString = rtrim($foreignKeysString, ',');

        return $foreignKeysString;
    }

    /**
     * Process the JSON Relationships.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONRelationships($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        if (!property_exists($fields, 'relationships')) {
            return '';
        }

        $relationsString = '';
        foreach ($fields->relationships as $relation) {
            $relationsString .= $relation->name . '#' . $relation->type . '#' . $relation->class . ';';
        }

        $relationsString = rtrim($relationsString, ';');

        return $relationsString;
    }

    /**
     * Process the JSON Validations.
     *
     * @param  string $file
     *
     * @return string
     */
    protected function processJSONValidations($file)
    {
        $json = File::get($file);
        $fields = json_decode($json);

        if (!property_exists($fields, 'validations')) {
            return '';
        }

        $validationsString = '';
        foreach ($fields->validations as $validation) {
            $validationsString .= $validation->field . '#' . $validation->rules . ';';
        }

        $validationsString = rtrim($validationsString, ';');

        return $validationsString;
    }
}
