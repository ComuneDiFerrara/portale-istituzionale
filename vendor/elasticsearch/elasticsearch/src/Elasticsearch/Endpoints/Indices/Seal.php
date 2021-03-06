<?php

declare(strict_types = 1);

namespace Elasticsearch\Endpoints\Indices;

use Elasticsearch\Endpoints\AbstractEndpoint;
use Elasticsearch\Common\Exceptions;

/**
 * Class Seal
 *
 * @category Elasticsearch
 * @package  Elasticsearch\Endpoints\Indices
 */
class Seal extends AbstractEndpoint
{
    /**
     * @throws \Elasticsearch\Common\Exceptions\RuntimeException
     * @return string
     */
    public function getURI()
    {
        $index = $this->index;
        $uri   = "/_seal";

        if (isset($index) === true) {
            $uri = "/$index/_seal";
        }

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array();
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'POST';
    }
}
