<?php

/*
 * (c) 2004-2009 Chris Corbyn
 *
 */

/**
 * A Simple MIME Header.
 *
 */
class Swift_Mime_Headers_UnstructuredHeader extends Swift_Mime_Headers_AbstractHeader
{
    /**
     * The value of this Header.
     *
     * @var string
     */
    private $value;

    /**
     * Creates a new SimpleHeader with $name.
     *
     * @param string $name
     */
    public function __construct($name, Swift_Mime_HeaderEncoder $encoder)
    {
        $this->setFieldName($name);
        $this->setEncoder($encoder);
    }

    /**
     * Get the type of Header that this instance represents.
     *
     *
     * @return int
     */
    public function getFieldType()
    {
        return self::TYPE_TEXT;
    }

    /**
     * Set the model for the field body.
     *
     * This method takes a string for the field value.
     *
     * @param string $model
     */
    public function setFieldBodyModel($model)
    {
        $this->setValue($model);
    }

    /**
     * Get the model for the field body.
     *
     * This method returns a string.
     *
     * @return string
     */
    public function getFieldBodyModel()
    {
        return $this->getValue();
    }

    /**
     * Get the (unencoded) value of this header.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the (unencoded) value of this header.
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->clearCachedValueIf($this->value != $value);
        $this->value = $value;
    }

    /**
     * Get the value of this header prepared for rendering.
     *
     * @return string
     */
    public function getFieldBody()
    {
        if (!$this->getCachedValue()) {
            $this->setCachedValue(
                $this->encodeWords($this, $this->value)
                );
        }

        return $this->getCachedValue();
    }
}
