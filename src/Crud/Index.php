<?php

namespace Rashidul\River\Crud;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

trait Index
{

    /**
     * Display a listing of the Resources.
     * @return Response
     * @internal param Request $request
     */
    public function index(Request $request)
    {
        $this->viewFile = $this->viewPrefix . '.datagrid';

        if ($request->ajax()) {
            $this->dataTableQuery = $this->model::select();
            $this->callHookMethod('querying');
            return Datatables::of($this->dataTableQuery)
                ->addIndexColumn()
                /*->addColumn('action', function ($row) {
                    return $this->getActionsHtml($row);
                })*/
                ->rawColumns(['action'])
                ->make(true);
        }
        $this->viewData = [
            'url_index' => route($this->routePrefix . '.index'),
            'url_create' => route($this->routePrefix . '.create'),
            'title' => Str::plural($this->modelName),
        ];

        $this->callHookMethod('indexing');

        return view($this->viewFile, $this->viewData);
    }


}
