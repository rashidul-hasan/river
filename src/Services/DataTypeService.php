<?php

namespace Rashidul\River\Services;

use Rashidul\River\Models\DataType;
use Rashidul\River\Models\FieldValue;

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
                    'type' => $this->getTypeText($field->type),
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

    private function getTypeText($typeInt)
    {
        if ($typeInt == 1) return 'text';
        if ($typeInt == 2) return 'email';
        if ($typeInt == 3) return 'password';
        if ($typeInt == 4) return 'image';
        if ($typeInt == 5) return 'checkbox';

        return '';
    }
}
