<?php
use open20\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
* Class m201204_190200_add_roles.php
*/
class m201204_190200_add_roles extends AmosMigrationPermissions
{

    protected function setRBACConfigurations()
    {

        return [
            
            [
                'name' =>  'UO',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Agid Unita organizzativa',
            ],
            [
                'name' =>  'PERSONE',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Agid Persone',
            ],
            [
                'name' =>  'SERVIZI',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Agid Servizi',
            ],

            [
                'name' =>  'DATASET',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Agid Dataset',
            ],
            [
                'name' =>  'DOCUMENTI',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Amos Documenti',
            ],
            [
                'name' =>  'NOTIZIE',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Amos News',
            ],
            [
                'name' =>  'EVENTI',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Amos Events',
            ],
            [
                'name' =>  'UTENTI',
                'type' => Permission::TYPE_ROLE,
                'description' => 'UTENTI',
            ],
            [
                'name' =>  'ARGOMENTI',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Tag',
            ],
            [
                'name' =>  'CMS',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Luya Cms',
            ],

        ];

    }

}