<?php

namespace Rashidul\River\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Rashidul\River\Models\DataEntry;
use Rashidul\River\Models\DataFields;
use Rashidul\River\Models\DataType;
use Rashidul\River\Models\FieldValue;
use Rashidul\River\Models\TemplatePage;
use Rashidul\River\Services\DataTypeService;
use Rashidul\River\Utility\FormBuilder;

class DataEntryController
{
    public function index(FormBuilder $formBuilder, DataTypeService $dataTypeService, $slug)
    {
        //TODO validate slug
        $d = DataType::slug($slug)->first();
        $f = $dataTypeService->getFields($slug);

        $fields = FieldValue::where('data_type_id', $d->id)
            ->get();
        $fields = $fields->groupBy('data_entry_id');

        $all_data = [];
        foreach ($fields as $id => $item) {
            $single['id'] = $id;
            foreach ($item as $field_val) {
                $single[$field_val->data_field_slug] = $field_val->value;
            }
            $all_data[] = $single;
        }

        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $headers = $dataTypeService->getIndexFields($slug);
        $data = [
            'title' => $d->plural ? $d->plural : $d->name,
            'data' => $all_data,
            'fields' => $f,
            '_top_buttons' => $buttons,
            'headers' => $headers
        ];

//        dd($data);
        return view('river::admin.dataentries.index', $data);
    }

    public function create(FormBuilder $formBuilder, DataTypeService $dataTypeService, $slug)
    {
        $f = $dataTypeService->getFields($slug);
        $d = DataType::slug($slug)->first();

        $form = $formBuilder->start(route('river.data-entries.store', $slug), 'POST')
            ->actionIsUrl()
            ->addFields($f)
            /*->fieldValues([
                'email' => 'kutta@bilai.com',
                'name' => 'kuku',
                'published' => 1,
                'address' => 'hghgdfhdf hgdfd',
            ])*/
            ->render();

        $all = DataType::all();
        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Add ' . $d->singular ? $d->singular : $d->name,
            'all' => $all,
            '_top_buttons' => $buttons,
            'form' => $form
        ];

        return view('river::admin.dataentries.create', $data);
    }

    public function store(Request $request, $slug, DataTypeService $dataTypeService)
    {
//        dd($request->all());
//        $request->validate([
//            'name' => 'required', //TODO no space, valid blade file name
//        ]);

        //TODO validation
        $d = DataType::slug($slug)->first();

        $entry = DataEntry::create([
            'data_type_id' => $d->id,
            'data_type_slug' => $slug,
        ]);

        $dataTypeService->insertMeta($request, $slug, $entry->id);
        return redirect(route('river.data-entries.index', $slug))
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
            'name' => 'required',
            'slug' => 'required',
        ]);

        $file = DataType::find($id);
        $file->name = $request->get('name');
        $file->slug = $request->get('slug');
        $file->save();

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
                'label' => $name,
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
