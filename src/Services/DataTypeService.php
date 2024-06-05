<?php

namespace BitPixel\SpringCms\Services;

use BitPixel\SpringCms\Models\DataType;
use BitPixel\SpringCms\Models\FieldValue;

class DataTypeService
{

    /*
     * return array of fields which can be passed to the FormBuilder
     *
     * */
    public function getFields($type_slug)
    {
        $d = DataType::slug($type_slug)
            ->with('fields')
            ->with('fields.metas')
            ->first(); //TODO load from cache

        $arr = [];

        foreach ($d->fields as $field) {
            $arr[$field->slug] = [
                'type' => $field->type,
                'label' => $field->label,
                'is_required' => $field->is_required,
                'metas' => $field->metas->toArray(),
            ];
        }

        return $arr;
    }

    /*
     * get array of field slugs which can be shown on data grid
     * */
    public function getIndexFields($type_slug)
    {
        $d = DataType::slug($type_slug)
            ->with('fields')
            ->first(); //TODO load from cache

        $arr = [];

        foreach ($d->fields as $field) {
            if ($field->show_on_list) {
                $arr[$field->slug] = [
                    'type' => $field->type,
                    'label' => $field->label,
                ];
            }
        }

        return $arr;
    }

    public function insertMeta($request, $type_slug, $entry_id)
    {
        $d = DataType::slug($type_slug)
            ->with('fields')
            ->first(); //TODO load from cache
        foreach ($d->fields as $field) {
            FieldValue::create([
                    'data_type_id' => $d->id,
                    'data_entry_id' => $entry_id,
                    'data_field_id' => $field->id,
                    'data_field_slug' => $field->slug,
                    'value' => $request->get($field->slug),
                ]);
        }
    }

}
