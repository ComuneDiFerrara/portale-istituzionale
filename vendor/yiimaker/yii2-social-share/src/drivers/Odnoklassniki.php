<?php
/**
 */

namespace ymaker\social\share\drivers;

use ymaker\social\share\base\AbstractDriver;

/**
 * Driver for Ok.ru.
 *
 *
 * @since 2.1
 */
class Odnoklassniki extends AbstractDriver
{
    /**
     * {@inheritdoc}
     */
    protected function processShareData()
    {
        $this->url = static::encodeData($this->url);
        $this->title = static::encodeData($this->title);
        $this->description = static::encodeData($this->description);
        $this->imageUrl = static::encodeData($this->imageUrl);
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
        return 'https://connect.ok.ru/offer'
            . '?url={url}'
            . '&title={title}'
            . '&description={description}'
            . '&imageUrl={imageUrl}';
    }
}
