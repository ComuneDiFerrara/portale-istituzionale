<?php
/**
 */

namespace Zend\Http\Header;

/**
 * @throws Exception\InvalidArgumentException
 */
class ContentDisposition implements HeaderInterface
{
    /**
     * @var string
     */
    protected $value;

    public static function fromString($headerLine)
    {
        list($name, $value) = GenericHeader::splitHeaderLine($headerLine);

        // check to ensure proper header type for this factory
        if (strtolower($name) !== 'content-disposition') {
            throw new Exception\InvalidArgumentException(sprintf(
                'Invalid header line for Content-Disposition string: "%s"',
                $name
            ));
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
        return 'Content-Disposition';
    }

    public function getFieldValue()
    {
        return (string) $this->value;
    }

    public function toString()
    {
        return 'Content-Disposition: ' . $this->getFieldValue();
    }
}
