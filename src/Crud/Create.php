<?php
namespace BitPixel\SpringCms\Crud;


use Rashidul\RainDrops\Facades\FormBuilder;
use Symfony\Component\HttpFoundation\Response;

trait Create
{

    /**
     * Show the form for creating a new Resource.
     * @return Response
     * @internal param Request $request
     */
    public function create()
    {
        $this->viewData = [
            'action' => route($this->routePrefix . '.store'),
            'method' => 'POST',
            'title' => 'Add ' . $this->modelName,
            'model' => new $this->model,
        ];
        $this->callHookMethod('creating');
        return view($this->viewPrefix . '.form', $this->viewData);
    }
}
