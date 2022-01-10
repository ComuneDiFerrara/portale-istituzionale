<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    frontend\modules\cftag\utility
 * @category   CategoryName
 */

namespace frontend\modules\cftag\utility;

use open20\amos\tag\models\Tag;
use open20\amos\tag\utility\TagUtility;

/**
 * Class CfTagUtility
 * @package frontend\modules\cftag\utility
 */
class CfTagUtility extends TagUtility
{
    const ARGUMENTS_TREE_ROOT_ID = 1;
    
    /**
     * Find the roles tree tag.
     * @return Tag
     */
    public static function getArgumentsTreeRootTag()
    {
        return Tag::findOne(['id' => self::ARGUMENTS_TREE_ROOT_ID]);
    }
    
    /**
     * This method returns all tags of the "arguments" tree.
     * @param bool $onlyIds
     * @return array
     */
    public static function findArgumentsTreeTags($onlyIds = false)
    {
        $tag = self::getArgumentsTreeRootTag();
        return self::findTreeTags($tag, $onlyIds);
    }
}
