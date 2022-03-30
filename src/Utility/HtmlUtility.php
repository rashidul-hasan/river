<?php

namespace Rashidul\River\Utility;

class HtmlUtility
{
    public static function selectFromEnum(FieldTypes $enum, $value)
    {
        $html = '';
        foreach ($enum->cases as $case) {
            $html .= '<option value="'.$case->value.'">'.$case->name.'</option>';
        }

        return $html;
    }

}
