<?php
/**
 */

namespace conquer\oauth2;

use yii\web\IdentityInterface;

/**
 * Interface OAtuh2IdentityInterface
 * @package conquer\oauth2
 */
interface OAuth2IdentityInterface
{
    /**
     * Find idenity by username
     * @param string $username current username
     * @return IdentityInterface
     */
    public static function findIdentityByUsername($username);

    /**
     * Validates password
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password);
}
