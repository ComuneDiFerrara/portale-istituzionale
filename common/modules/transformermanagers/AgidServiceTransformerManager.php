<?php
namespace common\modules\transformermanagers;

use open20\agid\service\models\AgidService;
use open20\elasticsearch\transformer\AbstractTransformerManager;


class AgidServiceTransformerManager extends AbstractTransformerManager
{
    public function init() {
        parent::init();
        $this->objectClass = AgidService::className();
    }
    
    public function getElasticToModelTransformer() 
    {
        return new AgidServiceEtoMTransformer(['objectClass' => $this->getObjectClass()]);
    }

    public function getModelToElasticTransformer() 
    {
        return new AgidServiceMtoETransformer(['objectClass' => $this->getObjectClass()]);
    }
}
