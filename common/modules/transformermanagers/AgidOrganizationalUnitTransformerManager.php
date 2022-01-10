<?php
namespace common\modules\transformermanagers;

use open20\agid\organizationalunit\models\AgidOrganizationalUnit;
use open20\elasticsearch\transformer\AbstractTransformerManager;


class AgidOrganizationalUnitTransformerManager  extends AbstractTransformerManager
{
    public function init() {
        parent::init();
        $this->objectClass = AgidOrganizationalUnit::className();
    }
    
    public function getElasticToModelTransformer() 
    {
        return new AgidOrganizationalUnitEtoMTransformer(['objectClass' => $this->getObjectClass()]);
    }

    public function getModelToElasticTransformer() 
    {
        return new AgidOrganizationalUnitMtoETransformer(['objectClass' => $this->getObjectClass()]);
    }
}
