<?php

namespace luya\cms\base;

use luya\cms\models\NavItem;
use yii\base\Controller;

/**
 * Abstract class for all Item Types.
 *
 * @property Controller $controller The controller object.
 * @property array $options Optional settings for the nav item type.
 * @property NavItem $navItem
 *
 * @since 1.0.0
 */
abstract class NavItemType extends \yii\db\ActiveRecord
{
    /**
     * Get the response content for the item type
     *
     * @return mixed
     */
    abstract public function getContent();
    
    /**
     * Get the corresponding nav item type for this type object
     *
     * @return NavItem An active record type.
     */
    public function getNavItem()
    {
        return $this->hasOne(NavItem::class, ['nav_item_type_id' => 'id'])->where(['nav_item_type' => static::getNummericType()]);
    }

    /**
     * Context properts array.
     *
     * @return array
     */
    public function getContextPropertysArray()
    {
        return []; // override
    }
    
    private $_controller;
    
    /**
     * Setter method to store the current controller Object
     * @param Controller $controller The controller object.
     */
    public function setController(Controller $controller)
    {
        $this->_controller = $controller;
    }
    
    /**
     * Getter method for the controller object.
     *
     * @return Controller
     */
    public function getController()
    {
        return $this->_controller;
    }
    
    private $_options = [];

    /**
     * Setter method for options.
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        $this->_options = $options;
    }

    /**
     * Getter method for options.
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Get a specific option value for a defined eky.
     *
     * @param string $key The array key to lookup inside the $options array.
     * @return boolean|mixed
     */
    public function getOption($key)
    {
        return isset($this->_options[$key]) ? $this->_options[$key] : false;
    }
}
