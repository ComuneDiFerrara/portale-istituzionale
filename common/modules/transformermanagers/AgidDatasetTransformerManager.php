<?php
namespace common\modules\transformermanagers;

use open20\agid\dataset\models\AgidDataset;
use open20\elasticsearch\transformer\AbstractTransformerManager;

class AgidDatasetTransformerManager extends AbstractTransformerManager
{
    public function init() 
	{
        parent::init();
        $this->objectClass = AgidDataset::className();
    }
    
    public function getElasticToModelTransformer() 
    {
        return new AgidDatasetEtoMTransformer(['objectClass' => $this->getObjectClass()]);
    }

    public function getModelToElasticTransformer() 
    {
        return new AgidDatasetMtoETransformer(['objectClass' => $this->getObjectClass()]);
    }
}
