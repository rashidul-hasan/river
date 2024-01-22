<?php

namespace Rashidul\River\Services;

use Illuminate\Support\Facades\DB;
use Rashidul\River\Models\DataEntry;
use Rashidul\River\Models\DataType;
use Rashidul\River\Models\FieldValue;
use Rashidul\River\Utility\Field;
use Rashidul\River\Utility\FieldCollection;

class DataEntryService
{

    protected $dataTypeService;


    /*
     * return array of data entries
     *
     * */
    /**
     * @param $dataTypeService
     */
    public function __construct(DataTypeService $dataTypeService)
    {
        $this->dataTypeService = $dataTypeService;
    }

    public function getAll($type_slug)
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

    /*
     * get a single data entry by slug & id
     * */
    public function find($type_slug, $data_entry_id)
    {
        /*$fields = $this->dataTypeService->getFields($type_slug);*/
        $entry = DataEntry::slug($type_slug)
            ->where('id', $data_entry_id)
            ->first();

//        dd($entry);
        if ($entry == null) {
            return [];
        }

        $arr = [];
        $values = $entry->values;
        foreach ($values as $value) {
            $arr['id'] = $data_entry_id;
            $arr[$value->data_field_slug] = $value->value;
        }

        return $arr;
    }

    public function update($type_slug, $data_entry_id, $inputArr)
    {
        /*$fields = $this->dataTypeService->getFields($type_slug);*/
        $d = DataType::slug($type_slug)
            ->with('fields')
            ->first(); //TODO load from cache
        foreach ($d->fields as $field) {
            if (array_key_exists($field->slug, $inputArr)) {
                $check = FieldValue::where([
                    'data_entry_id' => $data_entry_id,
                    'data_field_slug' => $field->slug
                ])->first();
                //TODO imoplement udpate or create

                if ($check) {
                    FieldValue::where([
                        'data_entry_id' => $data_entry_id,
                        'data_field_slug' => $field->slug
                    ])->update([
                        'value' => $inputArr[$field->slug]
                    ]);
                } else {
                    FieldValue::create([
                        'data_type_id' => $d->id,
                        'data_entry_id' => $data_entry_id,
                        'data_field_id' => $field->id,
                        'data_field_slug' => $field->slug,
                        'value' => $inputArr[$field->slug]
                    ]);
                }
            }
        }

        /*FieldValue::updateOrCreate(
            [
                'data_entry_id' => $data_entry_id,
                'data_field_slug' => $field->slug,
                'data_type_id' => $d->id,
//                        'data_field_id' => $field->id,
            ],
            [
                'value' => $inputArr[$field->slug]
            ]
        );*/
        /*return $arr;*/
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
