<?php

namespace BitPixel\SpringCms\Utility;

abstract class BaseField
{
    protected string $slug;

    protected string $label;

    protected FieldTypes $type;

    /**
     * @param string $slug
     */
    public function __construct(string $slug, string $label = null, FieldTypes $type = FieldTypes::Text)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }




}
