<?php

namespace Rashidul\River\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Rashidul\River\Models\DataEntry;
use Rashidul\River\Models\DataFields;
use Rashidul\River\Models\DataType;
use Rashidul\River\Models\FieldValue;
use Rashidul\River\Models\RolePermission;
use Rashidul\River\Services\DataEntryService;
use Rashidul\River\Services\DataTypeService;
use Rashidul\River\Utility\FormBuilder;
use Rashidul\River\Utility\RolesCache;

class DataEntryController
{
    public function index(FormBuilder $formBuilder, DataTypeService $dataTypeService, $slug)
    {
        if (!RolesCache::hasPermission(
            $slug . '.index',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }
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
            ['Add', route('river.data-entries.create', $slug), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $headers = $dataTypeService->getIndexFields($slug);
        $data = [
            'title' => $d->plural ? $d->plural : $d->name,
            'data' => $all_data,
            'fields' => $f,
            '_top_buttons' => $buttons,
            'headers' => $headers,
            'data_slug' => $slug
        ];

        return view('river::admin.dataentries.index', $data);
    }

    public function create(FormBuilder $formBuilder, DataTypeService $dataTypeService, $slug)
    {
        if (!RolesCache::hasPermission(
            $slug . '.create',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

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
            ['Add', route('river.data-entries.create', $slug), 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Add ' . $d->singular ? $d->singular : $d->name,
            'all' => $all,
            '_top_buttons' => $buttons,
            'form' => $form
        ];

        return view('river::admin.dataentries.create', $data);
    }

    public function edit(
        FormBuilder $formBuilder,
        DataTypeService $dataTypeService,
        DataEntryService $dataEntryService,
        $slug,
        $id
    ) {
        if (!RolesCache::hasPermission(
            $slug . '.update',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

        $entryAsArray = $dataEntryService->find($slug, $id);
        if (count($entryAsArray) == 0) {
            return redirect()->back()
                ->with('error', 'Data not found!');
        }

        $f = $dataTypeService->getFields($slug);
        $d = DataType::slug($slug)->first();

        $form = $formBuilder->start(route('river.data-entries.update', ['slug' => $slug, 'id' => $id]), 'PUT')
            ->actionIsUrl()
            ->addFields($f)
            ->fieldValues($entryAsArray)
            ->render();

        $buttons = [
            ['Add', '', 'btn btn-primary', 'btn-add-new' /*label,link,class,id*/],
        ];
        $data = [
            'title' => 'Edit ' . ($d->singular ? $d->singular : $d->name),
            '_top_buttons' => $buttons,
            'form' => $form,
            'data' => $entryAsArray
        ];

        return view('river::admin.dataentries.edit', $data);
    }

    public function store(Request $request, $slug, DataTypeService $dataTypeService)
    {
        if (!RolesCache::hasPermission(
            $slug . '.create',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

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

    public function update(
        Request $request,
        DataEntryService $dataEntryService,
        $slug,
        $id
    ) {
        if (!RolesCache::hasPermission(
            $slug . '.update',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

        //TODO handle validation
        $input = $request->except(['_token', '_method']);
        $dataEntryService->update($slug, $id, $input);

        return redirect(route('river.data-entries.index', $slug))
            ->with('success', 'Updated');
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

    public function destroy($slug, $id)
    {
        if (!RolesCache::hasPermission(
            $slug . '.delete',
            RolePermission::TYPE_CUSTOMTYPE
        )) {
            abort(503);
        }

        $entry = DataEntry::slug($slug)
            ->where('id', $id)
            ->first();
        if ($entry == null) {
            return redirect()->back()
                ->with('error', 'Data not found!');
        }

        //delete all field values
        FieldValue::id($id)
            ->delete();
        $entry->delete();

        //TODO reset cache
        return redirect()->back()
            ->with('success', 'Deleted!');
    }
}
