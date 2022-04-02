<?php

namespace Rashidul\River\Crud;

use Illuminate\Container\Container;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Rashidul\River\Crud\Create;
use Rashidul\River\Crud\CrudAction;
use Rashidul\River\Crud\Data;
use Rashidul\River\Crud\Destroy;
use Rashidul\River\Crud\Edit;
use Rashidul\River\Crud\Index;
use Rashidul\River\Crud\ResponseBuilder;
use Rashidul\River\Crud\Show;
use Rashidul\River\Crud\Store;
use Rashidul\River\Crud\Update;
use Yajra\DataTables\DataTables;

abstract class BaseCrudController
{
    use ValidatesRequests, Index, Create, Show, Edit,
        Update, Data, Store, Destroy;

    protected $modelClass;
    protected $model;
    protected $dataTable;
    protected $request;
    protected $responseBuilder;

    // data that will be passed into the view
    protected $viewData;

    // query builder object used by datatable
    protected $dataTableQuery;
    protected $dataTableObject;

    // transformer class to be used by datatble
//    protected $dataTransformer = DataTableTransformer::class;

    // views
    protected $indexView = 'raindrops::crud.table';
    protected $createView = 'raindrops::crud.form';
    protected $detailsView = 'raindrops::crud.table';
    protected $editView = 'raindrops::crud.form';

    // class to handle crud actions
    protected $crudAction;

    protected $container;

    /**
     * BaseController constructor.
     * @internal param $formRequest
     * @internal param $dataTable
     */
    public function __construct()
    {
        $this->dataTable = app(Datatables::class);
        $this->responseBuilder = new ResponseBuilder();
        $this->model = new $this->modelClass;
        $this->crudAction = new CrudAction($this->model);
        $this->container = Container::getInstance();

        if (property_exists($this, 'inject')){
            foreach ($this->inject as $property_name => $class){
                if (class_exists($class)){
                    $this->{$property_name} = app($class);
                }
            }
        }

        $this->middleware(function ($request, $next) {
            $this->request = $request;

            $this->callHookMethod('setup');

            return $next($request);
        });
    }

    protected function callHookMethod($name)
    {
        if (method_exists($this, $name))
        {
            $this->container->call([$this, $name]);
        }
    }

    protected function setRedirectUrl()
    {
        if (!array_key_exists('redirect', $this->viewData)) {
            $this->viewData['redirect'] = $this->model->getShowUrl();
        }
    }

}
