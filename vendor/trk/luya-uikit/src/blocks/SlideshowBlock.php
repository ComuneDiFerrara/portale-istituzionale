<?php

namespace trk\uikit\blocks;

use trk\uikit\BaseUikitBlock;
use trk\uikit\Module;
use luya\cms\frontend\blockgroups\MediaGroup;

/**
 * Slideshow Block.
 *
 */
final class SlideshowBlock extends BaseUikitBlock
{
    /**
     * @inheritdoc
     */
    public $component = "slideshow";

    /**
     * @inheritdoc
     */
    public function blockGroup()
    {
        return MediaGroup::class;
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('slideshow');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'burst_mode';
    }

    /**
     * @inheritdoc
     */
    public function frontend(array $params = array())
    {
        if(count($this->getVarValue('items', []))) {
            return parent::frontend($params);
        } else {
            return "";
        }
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        if($output = $this->frontend()) {
            return $output;
        } else {
            return '<div><span class="block__empty-text">' . Module::t('no_content') . '</span></div>';
        }
    }
}
