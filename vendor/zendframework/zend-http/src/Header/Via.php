<?php
/**
 */

namespace Zend\Http\Header;

/**
 * @throws Exception\InvalidArgumentException
 */
class Via implements HeaderInterface
{
    /**
     * @var string
     */
    protected $value;

    public static function fromString($headerLine)
    {
        list($name, $value) = GenericHeader::splitHeaderLine($headerLine);

        // check to ensure proper header type for this factory
        if (strtolower($name) !== 'via') {
            throw new Exception\InvalidArgumentException('Invalid header line for Via string: "' . $name . '"');
        }

        // @todo implementation details
        return new static($value);
    }

    public function __construct($value = null)
    {
        if ($value !== null) {
            HeaderValue::assertValid($value);
            $this->value = $value;
        }
    }

    public function getFieldName()
    {
        return 'Via';
    }

    public function getFieldValue()
    {
        return (string) $this->value;
    }

    public function toString()
    {
        return 'Via: ' . $this->getFieldValue();
    }
}
