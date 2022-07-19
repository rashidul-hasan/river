<?php

namespace Rashidul\River\Commands\Generators;

use File;
use Illuminate\Console\Command;
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

        $this->call('river:make-model', ['name' => "{$entitySingular}"]);
        $this->call('river:make-view', ['name' => $slug]);
        $this->call('river:make-controller', ['name' => "{$entitySingular}Controller", '--slug' => $slug]);


        $this->info('CRUD generated!');


        return true;
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

}
