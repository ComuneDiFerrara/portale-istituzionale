<?php

namespace trk\uikit\blockgroups;

/**
 * Multiple Block Group.
 *
 */
class MultipleGroup extends \luya\cms\base\BlockGroup
{
    public function identifier()
    {
        return 'multiple';
    }

    public function label()
    {
        return 'Multiple';
    }

    public function getPosition()
    {
        return 70;
    }
}