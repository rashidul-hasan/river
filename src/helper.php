<?php

use Rashidul\River\Models\DataType;
use Rashidul\River\Models\FieldValue;
use Rashidul\River\Services\SettingsService;
use Rashidul\River\Models\Faq;
use Rashidul\River\Models\Menu;
use Rashidul\River\Models\Blog;
use Rashidul\River\Models\Testimonial;

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

if (! function_exists('river_get_testimonials')) {
    function river_get_testimonials()
    {
        //TODO use cache
        //for the first time, there will be no tables in the db so this function will throw exception
        //Base table or view not found: 1146
        try {
            return $testimonial = Testimonial::where('is_active', 1)->orderBy('sort_order', 'ASC')->get();
        } catch (Exception $e) {
            
            return [];
        }
    }
}

if (! function_exists('river_get_menu')) {
    function river_get_menu($slug)
    {
       
        try {
            $data = Menu::where('is_active', 1)->where('slug', $slug)->first();
            $field_data= $data->menuitem;
            $sorted = $field_data->sortBy('sort_order');
            $sorted->values()->all();
            return  $sorted ;
        } catch (Exception $e) {
            
            return [];
        }
    }
}

if (! function_exists('river_latest_blogs')) {
    function river_latest_blogs()
    {
       
        try {
            $data = Blog::with('tag')->latest()->take(5)->get();
            return $data;

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
