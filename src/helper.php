<?php

use Rashidul\River\Models\DataType;
use Rashidul\River\Models\FieldValue;
use Rashidul\River\Services\SettingsService;

if (! function_exists('river_settings')) {
    function river_settings($key, $default = '')
    {
        //TODO use cache
        return SettingsService::get($key, $default);
    }
}

if (! function_exists('river_find')) {
    function river_find($type_slug, $filter = [])
    {
        $d = DataType::slug($type_slug)->first();
        $dataTypeService = new \Rashidul\River\Services\DataTypeService();
        $f = $dataTypeService->getFields($type_slug);

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

        return $all_data;
    }
}
