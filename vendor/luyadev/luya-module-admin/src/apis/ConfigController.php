<?php

namespace luya\admin\apis;

/**
 * Config Controller.
 *
 * @since 1.0.0
 */
class ConfigController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'luya\admin\models\Config';
}
