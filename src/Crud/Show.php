<?php

namespace BitPixel\SpringCms\Crud;


use Rashidul\RainDrops\Facades\DetailsTable;

trait Show
{

    /**
     * Display the specified Resource.
     *
     * @param  int $id
     * @return Response
     * @internal param Request $request
     */
    public function show($id)
    {
        $model = $this->model::findOrFail($id);
        $this->viewData = [
            'title' => $model->name,
            'model' => $model
        ];

        $this->callHookMethod('showing');
        return view($this->viewPrefix . '.show', $this->viewData);
    }

}
