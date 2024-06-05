<?php

namespace BitPixel\SpringCms\Crud;


use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Rashidul\RainDrops\Model\ModelHelper;

trait Store
{

    /**
     * Store a newly created resource in storage.
     * @return Response
     * @internal param Request $request
     * @internal param Request $request
     */
    public function store(Request $request)
    {

        $this->validateRequest($request);

        $this->modelObj = new $this->model;
        $this->modelObj->fill($request->except(['_method', '_token']));

        $this->modelObj = $this->uploadImages($request, $this->modelObj);
        $this->modelObj = $this->handleCheckboxes($request, $this->modelObj);

        $this->callHookMethod('storing');
        $this->modelObj->save();
        $this->callHookMethod('stored');

        return redirect(route($this->routePrefix . '.index'))
            ->with('success', 'Created!');

    }

}
