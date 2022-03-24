<?php

namespace Rashidul\River\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Rashidul\River\Constants;
use Rashidul\River\Models\DataEntry;
use Rashidul\River\Models\DataFields;
use Rashidul\River\Models\DataType;
use Rashidul\River\Models\TemplatePage;
use Rashidul\River\Utility\FormBuilder;

class DataTypeController
{
    public function index()
    {
        /*$type = DataType::slug('student')
            ->first();

        $fields = $type->fields;


        dd($fields);*/
        $all = DataType::all();
        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Data types',
            'all' => $all,
            '_top_buttons' => $buttons
        ];

        return view('river::admin.datatypes.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', //TODO no space, valid blade file name
        ]);

        $file = DataType::create([
            'singular' => $request->get('name'),
            'plural' => Str::plural($request->get('name')),
            'slug' => Str::slug($request->get('name')),
        ]);
        Cache::forget(Constants::CACHE_KEY_DATATYPES);
        return redirect(route('river.datatypes.edit', $file->id))
            ->with('success', 'Created!');
    }

    public function edit($id)
    {
        $file = DataType::find($id);
        $data = [
            'title' => 'Edit: ' . $file->name,
            'type' => $file
        ];

        return view('river::admin.datatypes.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'singular' => 'required',
            'slug' => 'required',
        ]);

        $file = DataType::find($id);
        $file->singular = $request->get('singular');
        $file->plural = $request->get('plural');
        $file->slug = $request->get('slug');
        $file->icon = $request->get('icon');
        $file->show_on_menu = $request->has('show_on_menu') ? 1 : 0;
        $file->save();

        Cache::forget(Constants::CACHE_KEY_DATATYPES);
        return redirect()->back()->with('success', 'Updated');
    }

    public function storeFields(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $names = $request->get('name');
        $id = $request->get('type_id');
        $names = explode(",", $names);
        foreach ($names as $name) {
            DataFields::create([
                'slug' => $name,
                'label' => ucwords(str_replace('_', ' ', $name)),
                'type' => DataFields::TYPE_TEXT,
                'data_type_id' => $request->get('type_id'),
            ]);
        }

        return redirect(route('river.datatypes.edit', [$id, 'tab' => 'fields']))
            ->with('success', 'Created');

    }

    public function updateFields(Request $request)
    {
        $id = $request->get('type_id');
        $fields = $request->get('field');
        foreach ($fields as $fieldid => $values) {
            $f = DataFields::find($fieldid);
            $f->fill([
                'slug' => $values['slug'],
                'label' => $values['label'],
                'type' => $values['type'],
                'is_required' => array_key_exists('is_required', $values) ? 1 : 0,
            ]);
            $f->save();
        }

        return redirect(route('river.datatypes.edit', [$id, 'tab' => 'fields']))
            ->with('success', 'Updated');

    }

    public function destroy($id)
    {
        $file = TemplatePage::find($id);
        $file->delete();

        //reset cache
        Artisan::call('river:cache-views');
        return redirect(route('river.template-pages.index'))
            ->with('success', 'Deleted!');
    }
}
