<?php

declare(strict_types = 1);

namespace Elasticsearch\Endpoints\Indices\Gateway;

use Elasticsearch\Endpoints\AbstractEndpoint;

/**
 * Class Snapshot
 *
 * @category Elasticsearch
 * @package  Elasticsearch\Endpoints\Indices\Gateway
 */
class Snapshot extends AbstractEndpoint
{
    /**
     * @return string
     */
    public function getURI()
    {
        $index = $this->index;
        $uri   = "/_gateway/snapshot";

        if (isset($index) === true) {
            $uri = "/$index/_gateway/snapshot";
        }

        return $uri;
    }

    /**
     * @return string[]
     */
    public function getParamWhitelist()
    {
        return array(
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards'
        );
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return 'POST';
    }
}
