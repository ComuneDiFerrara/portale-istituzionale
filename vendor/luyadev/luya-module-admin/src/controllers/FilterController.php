<?php

namespace luya\admin\controllers;

use luya\admin\Module;
use luya\admin\ngrest\base\Controller;

/**
 * NgRest Filter Controller.
 *
 * @since 1.0.0
 */
class FilterController extends Controller
{
    public $modelClass = 'luya\admin\models\StorageFilter';

    public function getDescription()
    {
        return Module::t('filter_controller_description');
    }
}
