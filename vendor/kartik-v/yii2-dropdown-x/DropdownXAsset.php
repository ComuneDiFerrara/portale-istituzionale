<?php

/**
 * @package yii2-context-menu
 * @version 1.2.0
 */

namespace kartik\dropdown;

/**
 * DropdownX bundle for \kartik\dropdown\DropdownX
 *
 * @since 1.0
 */
class DropdownXAsset extends \kartik\base\AssetBundle
{

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/dropdown-x']);
        $this->setupAssets('js', ['js/dropdown-x']);
        parent::init();
    }

}