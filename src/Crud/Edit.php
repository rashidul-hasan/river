<?php

namespace BitPixel\SpringCms\Crud;


use Rashidul\RainDrops\Facades\FormBuilder;

trait Edit
{

    /**
     * Show the form for editing the specified Resource.
     *
     * @param  int $id
     * @return Response
     * @internal param Request $request
     */
    public function edit($id)
    {

        $this->viewFile = $this->viewPrefix . '.form';
        $model = $this->model::findOrFail($id);
        $this->viewData = [
            'action' => route($this->routePrefix . '.update', $id),
            'method' => 'PUT',
            'title' => 'Edit ' . $this->modelName,
            'model' => $model,
        ];
        $this->callHookMethod('editing');
        return view($this->viewFile, $this->viewData);
    }
}
