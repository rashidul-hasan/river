<?php

namespace Rashidul\River\Utility;

enum FieldTypes: int
{
    case Text = 1;
    case Email = 2;
    case Password = 3;
    case Phone = 4;
    case Date = 5;
    case DateTime = 6;
    case Image = 7;
    case RichText = 8;
    case Checkbox = 9;
    case Dropdown = 10;

    public function typeCode(): int
    {
        return match($this) {
            FieldTypes::Text => 1,
            FieldTypes::Email => 2,
            FieldTypes::Password => 3,
            FieldTypes::Phone => 4,
            FieldTypes::Date => 5,
        };
    }
}
