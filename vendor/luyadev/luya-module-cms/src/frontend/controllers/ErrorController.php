<?php

namespace luya\cms\frontend\controllers;

use Yii;

/**
 * CMS Error Handler Rendering
 *
 * @since 1.0.0
 */
class ErrorController extends \luya\web\Controller
{
    public function actionIndex()
    {
        return $this->renderPartial($this->module->errorViewFile, [
            'exception' => Yii::$app->errorHandler->exception
        ]);
    }
}
