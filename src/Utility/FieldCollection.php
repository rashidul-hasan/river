<?php

namespace Rashidul\River\Utility;

class FieldCollection
{

    protected array $fields = [];

    public function add(Field $field)
    {
        $this->fields[] = $field;
        return $this;
    }

    public function addMultiple(array $fields)
    {
        //TODO validate $fields
        $this->fields = array_merge($this->fields[], $fields);
        return $this;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }


}
