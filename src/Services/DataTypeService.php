<?php

namespace Rashidul\River\Services;

use Illuminate\Support\Facades\DB;
use Rashidul\River\Models\DataType;
use Rashidul\River\Utility\Field;
use Rashidul\River\Utility\FieldCollection;

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
            ->first(); //TODO load from cache

        $arr = [];

        foreach ($d->fields as $field) {
            $arr[$field->slug] = [
                'type' => $this->getTypeText($field->type),
                'label' => $field->label,
            ];
        }

        return $arr;
    }

    public function insertMeta($request, $type_slug, $entry_id)
    {
        $d = DataType::slug($type_slug)
            ->with('fields')
            ->first(); //TODO load from cache
        foreach ($d->fields as $field) {
            DB::table('field_values')
                ->insert([
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
