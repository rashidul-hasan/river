<?php

use Rashidul\River\Models\DataType;
use Rashidul\River\Models\FieldValue;
use Rashidul\River\Services\SettingsService;
use Rashidul\River\Models\Faq;

if (! function_exists('river_settings')) {
    function river_settings($key, $default = '')
    {
        //TODO use cache
        //for the first time, there will be no tables in the db so this function will throw exception
        //Base table or view not found: 1146
        try {
            return SettingsService::get($key, $default);
        } catch (Exception $e) {
            return $default;
        }
    }
}

if (! function_exists('river_get_faqs')) {
    function river_get_faqs($type)
    {
        //TODO use cache
        //for the first time, there will be no tables in the db so this function will throw exception
        //Base table or view not found: 1146
        try {
            return Faq::where('is_active', 1)
            ->where('type', $type)->orderBy('sort_order', 'ASC')->get();
        } catch (Exception $e) {
            
            return [];
        }
    }
}



if (! function_exists('river_banner')) {
    function river_banner($slug, $default = '')
    {
        $banner = \Rashidul\River\Models\Banner::where('slug', $slug)->first();
        if ($banner){
            return $banner->image;
        }
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
