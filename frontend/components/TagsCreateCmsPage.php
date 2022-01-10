<?php

namespace app\components;

use amos\cmsbridge\models\PostCmsCreatePage;
use amos\cmsbridge\utility\CmsUtility;
use open20\amos\tag\models\Tag;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;

class TagsCreateCmsPage extends Component implements BootstrapInterface {

    public function bootstrap($app) {

        Event::on(Tag::className(),Tag::EVENT_AFTER_INSERT, function ($event) {
            $model = $event->sender;
            
            $utility = new CmsUtility();
            $page = new PostCmsCreatePage();
            $page->nav_item_type = 1;
            $page->parent_nav_id = 0;
            $page->is_draft = 0;
            $page->nav_container_id = \Yii::$app->params['menu_argomento']; // Menu
            $page->lang_id = 1;
            $page->use_draft = 1;
            $page->layout_id = 0;
            $page->from_draft_id = \Yii::$app->params['template_argomento']; 
            $page->title = $model->nome; // Titolo pagina
            $page->alias = $model->nome; // alias pagina
            $page->with_login = 0;
            $page->event_data->event_id = $model->id;
            $page->event_data->presentation = $model->nome;
            $page->event_data->description = $model->descrizione;
            $page->event_data->program = $model->descrizione;
            $page->event_data->url_image = $model->icon;
        
            $page->cms_user_id = $utility->loginCms();
            $result = $utility->createCmsPage($page, Yii::$app->params['platform']['frontendUrl'].'/api/1/base-create-page');
            if (!empty($result->status) && $result->status == 1) {
                //$this->luya_page_id = $result->nav_id;
                //$this->save(false);
            }
        });
    }

}
