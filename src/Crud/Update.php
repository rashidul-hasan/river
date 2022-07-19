<?php

namespace Rashidul\River\Crud;


use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Rashidul\RainDrops\Model\ModelHelper;

trait Update
{

    /**
     * Update the specified Resource in storage.
     *
     * @param Request $request
     * @param  int $id
     * @return Response
     * @internal param Request|UpdateSimCardRequest $request
     */
    public function update(Request $request, $id)
    {

        $this->validateRequest($request);

        $this->modelObj = $this->model::findOrFail($id);
        $this->modelObj->fill($request->except(['_method', '_token']));
        //handle images
        $this->modelObj = $this->uploadImages($request, $this->modelObj);
        $this->modelObj = $this->handleCheckboxes($request, $this->modelObj);
        $this->modelObj->save();

        $this->callHookMethod('updated');

        return redirect(route($this->routePrefix . '.index'))
            ->with('success', 'Updated!');

    }


}
