<?php

namespace luya\generic\blocks;

use luya\generic\Module;
use luya\generic\BaseGenericBlock;

/**
 * Simple horizontal line block
 *
 * @since 1.0.0
 */
final class LineBlock extends BaseGenericBlock
{
    /**
     * @inheritdoc
     */
    public $cacheEnabled = true;
    
    /**
     * @inheritdoc
     */
    public function name()
    {
        return Module::t('block_line_name');
    }

    /**
     * @inheritdoc
     */
    public function icon()
    {
        return 'remove';
    }
    
    /**
     * @inheritdoc
     */
    public function getIsDirtyDialogEnabled()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function config()
    {
        return [
           'vars' => [
                ['var' => 'lineSpace', 'label' => Module::t('block_line_linespace_label'), 'type' => 'zaa-select', 'options' => [
                    ['value' => '5px', 'label' => '5px ' . Module::t('block_line_linespace_space')],
                    ['value' => '10px', 'label' => '10px ' . Module::t('block_line_linespace_space')],
                    ['value' => '20px', 'label' => '20px ' . Module::t('block_line_linespace_space')],
                    ['value' => '30px', 'label' => '30px ' . Module::t('block_line_linespace_space')],
                ], 'initvalue' => '5px'],
                ['var' => 'lineStyle', 'label' => Module::t('block_line_linestyle_label'), 'type' => 'zaa-select', 'options' => [
                    ['value' => 'dotted', 'label' => Module::t('block_line_linestyle_dotted')],
                    ['value' => 'dashed', 'label' => Module::t('block_line_linestyle_dashed')],
                    ['value' => 'solid', 'label' => Module::t('block_line_linestyle_solid')],
                ], 'initvalue' => 'solid'],
                ['var' => 'lineWidth', 'label' => Module::t('block_line_linewidth_label'), 'type' => 'zaa-select', 'options' => [
                    ['value' => '1px', 'label' => '1px'],
                    ['value' => '2px', 'label' => '2px'],
                    ['value' => '3px', 'label' => '3px'],
                ], 'initvalue' => '1px'],
                ['var' => 'lineColor', 'label' => Module::t('block_line_linecolor_label'), 'type' => 'zaa-select', 'options' => [
                    ['value' => '#ccc', 'label' => Module::t('block_line_linecolor_grey')],
                    ['value' => '#000', 'label' => Module::t('block_line_linecolor_black')],
                ], 'initvalue' => '#ccc']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function admin()
    {
        return '<p><hr /></p>';
    }
}
