<?php
    use yii\helpers\Html;
    $iconSubmenu = '<span class="am am-chevron-down"></span>';
?>

<?php
if (!\Yii::$app->user->isGuest) {
    $cmsDefaultMenuPlugin .= Html::tag(
        'li',
        Html::a(
            Html::tag('span', 'Gestisci') . $iconSubmenu,
            null,
            [
                'class' => 'nav-link dropdown-toggle nav-link-plugin' . ' ',
                'target' => '_self',
                'title' => 'Gestisci',
                'href' => '#',
                'data' =>
                [
                    'toggle' => 'dropdown'
                ],
                'aria' =>
                [
                    'expanded' => 'false'
                ]
            ]
        ) .
            Html::tag(
                'div',
                Html::tag(
                    'div',
                    Html::tag(
                        'ul',
                        open20\amos\core\module\AmosModule::getModulesFrontEndMenus(2),
                        [
                            'class' => 'link-list'
                        ]
                    ),
                    [
                        'class' => 'link-list-wrapper'
                    ]
                ),
                [
                    //'id' => 'menuPlugin',
                    'class' => 'dropdown-menu'
                ]
            ),
        [
            'class' => 'nav-item dropdown' . ' '
        ]
    ).Html::tag(
        'li',
        Html::a(
            Html::tag('span', 'Tutti gli argomenti'),
            null,
            [
                'class' => 'nav-link ' . ' ',
                'target' => '_self',
                'title' => 'Tutti gli argomenti',
                'href' => '/tutti-gli-argomenti',
                
            ]
        ) ,
        [
            'class' => 'nav-item right-content' ,
            
            
        ]
    )
    
    ;
    echo($cmsDefaultMenuPlugin);
    
}
?>