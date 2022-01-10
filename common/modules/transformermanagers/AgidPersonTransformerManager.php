<?php
namespace common\modules\transformermanagers;

use open20\agid\person\models\AgidPerson;
use open20\elasticsearch\transformer\AbstractTransformerManager;


class AgidPersonTransformerManager extends AbstractTransformerManager
{
    public function init() 
	{
        parent::init();
        $this->objectClass = AgidPerson::className();
    }
    
    public function getElasticToModelTransformer() 
    {
        return new AgidPersonEtoMTransformer(['objectClass' => $this->getObjectClass()]);
    }

    public function getModelToElasticTransformer() 
    {
        return new AgidPersonMtoETransformer(['objectClass' => $this->getObjectClass()]);
    }
}
