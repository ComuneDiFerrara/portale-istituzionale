<?php
/**
 */
namespace dosamigos\google\maps\controls;

use dosamigos\google\maps\ObjectAbstract;
use dosamigos\google\maps\OptionsTrait;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/**
 * ScaleControlOptions
 *
 * Options for the rendering of the scale control.
 *
 * For further information please visit its
 * [documentation](https://developers.google.com/maps/documentation/javascript/reference#ScaleControlOptions) at
 * Google.
 *
 * @property string style Style id. Used to select what style of scale control to display.
 *
 * @package dosamigos\google\maps
 */
class ScaleControlOptions extends ObjectAbstract
{

    use OptionsTrait;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->options = ArrayHelper::merge(
            [
                'style' => null
            ],
            $this->options
        );
    }

    /**
     * Sets the style and checks whether is a valid [ScaleControlStyle] constant.
     *
     * @param $value
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function setStyle($value)
    {
        if (!ScaleControlStyle::getIsValid($value)) {
            throw new InvalidConfigException('Unknown "style" value');
        }

        $this->options['style'] = new JsExpression($value);
    }

} 