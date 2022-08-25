<?php

namespace Rashidul\River\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Rashidul\River\Models\DataType;
use Rashidul\River\Models\RiverPage;
use Rashidul\River\Models\Role;
use Rashidul\River\Models\RolePermission;
use Rashidul\River\Utility\RolesCache;
use Session;
use Termwind\Components\Dd;

class RiverPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $riverPages = RiverPage::all();
        $buttons = [
            ['Add New',route('river.pages.create'), 'btn btn-primary', 'btn-add-new'],
        ];
        $data = [
            'riverPages' => $riverPages,
            'title' => 'Pages',
            '_top_buttons' => $buttons,
        ];
        return view('river::admin.pages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buttons = [
            ['Back', route('river.pages.index'), 'btn btn-info', 'btn-add-new'],
        ];
        $data = [
            'title' => 'Page Create',
            '_top_buttons' => $buttons,
        ];
        return view('river::admin.pages.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $page = new RiverPage();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->menu_title = $request->menu_title;
        $page->content_type = $request->content_type;
        $page->content = isset($request->page_content1) ? $request->page_content1 : $request->page_content2;
        $page->is_published = isset($request->is_published) ? true : false;
        $page->save();

        return redirect()->route('river.pages.index')->with('success', 'Create Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buttons = [
            ['Back', route('river.pages.index'), 'btn btn-info', 'btn-add-new'],
        ];

        $riverPage = RiverPage::findOrFail($id);
        $data = [
            'title' => 'Edit Role',
            '_top_buttons' => $buttons,
            'riverPage' => $riverPage,
        ];
        return view('river::admin.pages.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

        $page = RiverPage::findOrFail($id);
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->menu_title = $request->menu_title;
        $page->content_type = $request->content_type;
        $page->content = isset($request->page_content1) ? $request->page_content1 : $request->page_content2;
        $page->is_published = isset($request->is_published) ? true : false;
        $page->save();

        return redirect()->route('river.pages.index')->with('success', 'Create Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = RiverPage::findOrFail($id);
        $data->delete();
        return redirect()->route('river.pages.index')->with('success', 'Successfully Deleted done!');
    }
}
