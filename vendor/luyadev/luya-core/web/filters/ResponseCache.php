<?php

namespace luya\web\filters;

use Yii;
use luya\traits\CacheableTrait;
use yii\filters\PageCache;

/**
 * Filter to enable Response Cache.
 *
 * Extends the {{yii\filters\PageCache}} class by using the {{luya\traits\CacheableTrait}} whether caching
 * is enabled or not. Thefore you can attach this page cache to any controller whether caching is enabled
 * or not, it will not throw an exception
 *
 * @since 1.0.0
 */
class ResponseCache extends PageCache
{
    use CacheableTrait;
    
    /**
     * @var array Define an array with the actions and a corresponding callable function. This will be called whether caching
     * is enabled or not or the response is loaded from the cache.
     *
     * ```php
     * 'actionsCallable' => ['get-posts' => function($result) {
     *     // do something whether is the response cached or not
     * });
     * ```
     *
     * @deprecated Replaced in favor of {{beforeCacheResponse}} and {{afterRestoreResponse}}. Will be removed in 2.0
     */
    public $actionsCallable = [];
    
    /**
     * @var array
     * @deprecated Use {{$only}} or {{$except}} instead. Will be removed in 2.0
     */
    public $actions = [];
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        // support deprecated $actions property
        if (!empty($this->actions)) {
            $this->only = $this->actions;
        }
    }
    
    /**
     * call the action callable if available.
     *
     * @param string $action The action ID name
     * @param string $result The cahed or not cached action response, this is a string as its after the action filters.
     */
    private function callActionCallable($action, $result)
    {
        if (isset($this->actionsCallable[$action]) && is_callable($this->actionsCallable[$action])) {
            call_user_func($this->actionsCallable[$action], $result);
        }
    }
    
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!$this->isCachable()) {
            return true;
        }
        
        $result = parent::beforeAction($action);
        
        // support legacy property.
        if (!empty($this->actionsCallable)) {
            $this->callActionCallable($action->id, Yii::$app->response->content);
        }
        
        return $result;
    }
}
