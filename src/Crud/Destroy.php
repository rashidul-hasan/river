<?php

namespace Rashidul\River\Crud;


use Illuminate\Database\QueryException;

trait Destroy
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     * @internal param Request $request
     */
    public function destroy($id)
    {
        $model = $this->model::findOrFail($id);
        $model->delete();

        return response()->json([
            'success' => true,
            'message' => 'Deleted Successfully!'
        ], 200);

    }

}
