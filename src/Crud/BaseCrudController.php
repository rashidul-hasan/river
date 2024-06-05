<?php

namespace BitPixel\SpringCms\Crud;

use Illuminate\Container\Container;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

abstract class BaseCrudController
{
    use ValidatesRequests, Index, Create, Show, Edit,
        Update, Data, Store, Destroy;

    protected $viewData = []; //array will be passed to blade view

    protected $dataTableQuery; // the query builder instance which is passed to datatable ajax

    protected $viewFile = '';

    protected $modelObj;

    /**
     * BaseController constructor.
     * @internal param $formRequest
     * @internal param $dataTable
     */
    public function __construct()
    {
        $this->dataTable = app(Datatables::class);
        $this->responseBuilder = new ResponseBuilder();
        /*$this->model = new $this->modelClass;*/
        $this->crudAction = new CrudAction($this->model);
        $this->container = Container::getInstance();

        if (property_exists($this, 'inject')){
            foreach ($this->inject as $property_name => $class){
                if (class_exists($class)){
                    $this->{$property_name} = app($class);
                }
            }
        }

        /*$this->middleware(function ($request, $next) {
            $this->request = $request;

            $this->callHookMethod('setup');

            return $next($request);
        });*/
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

    private function handleCheckboxes(Request $request, $model)
    {
        if (property_exists($this, 'checkbox_inputs') && count($this->checkbox_inputs)) {
            foreach ($this->checkbox_inputs as $checkbox_input) {
                $model->{$checkbox_input} = $request->has($checkbox_input) ? 1 : 0;
            }
        }
        return $model;
    }

    private function validateRequest(Request $request)
    {
        if (property_exists($this, 'validations')) {
            $request->validate($this->validations);
        }
        if (method_exists($this, 'getCreateValidations')) {
            $request->validate($this->getCreateValidations());
        }
    }

    protected function getActionsHtml($row)
    {
        $edit = route($this->routePrefix . '.edit', $row->id);
        $view = route($this->routePrefix . '.show', $row->id);
        $btn = "<a href=\"{$edit}\" class='btn btn-default btn-sm btn-link'>Edit</a>";
        $btn .= "<a href=\"{$view}\" class='btn btn-sm btn-link'>View</a>";
        $btn .= "<a href=\"\" class='dt-btn-remove btn btn-sm btn-link text-danger'>Remove</a>";

        return $btn;
    }

    protected function uploadImages(Request $request, $model)
    {
        if (property_exists($this, 'image_inputs') && count($this->image_inputs)) {
            foreach ($this->image_inputs as $image_input) {
                if ($request->hasFile($image_input)){
                    $model->{$image_input} = FileUploadService::uploadSingleImage($request->file($image_input), FileUploadService::UPLOAD_ALL_IAMGES);
                }
            }
        }
        return $model;
    }
}
