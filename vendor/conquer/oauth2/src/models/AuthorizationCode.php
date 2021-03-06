<?php
/**
 */

namespace conquer\oauth2\models;

use conquer\oauth2\Exception;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "oauth_authorization_code".
 *
 * @property string $authorization_code
 * @property string $client_id
 * @property integer $user_id
 * @property string $redirect_uri
 * @property integer $expires
 * @property string $scope
 *
 * @property Client $client
 * @property ActiveRecord $user
 */
class AuthorizationCode extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%oauth2_authorization_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['authorization_code', 'client_id', 'user_id', 'expires'], 'required'],
            [['user_id', 'expires'], 'integer'],
            [['scope'], 'string'],
            [['authorization_code'], 'string', 'max' => 40],
            [['client_id'], 'string', 'max' => 80],
            [['redirect_uri'], 'url'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'authorization_code' => 'Authorization Code',
            'client_id' => 'Client ID',
            'user_id' => 'User ID',
            'redirect_uri' => 'Redirect Uri',
            'expires' => 'Expires',
            'scope' => 'Scopes',
        ];
    }

    /**
     *
     * @param array $params
     * @throws Exception
     * @return AuthorizationCode
     * @throws \yii\base\Exception
     */
    public static function createAuthorizationCode(array $params)
    {
        static::deleteAll(['<', 'expires', time()]);

        $params['authorization_code'] = Yii::$app->security->generateRandomString(40);
        $authCode = new static($params);

        if ($authCode->save()) {
            return $authCode;
        } else {
            Yii::error(__CLASS__ . ' validation error: ' . VarDumper::dumpAsString($authCode->errors));
        }
        throw new Exception(Yii::t('conquer/oauth2', 'Unable to create authorization code.'), Exception::SERVER_ERROR);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['client_id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $identity = isset(Yii::$app->user->identity) ? Yii::$app->user->identity : null;
        if ($identity instanceof ActiveRecord) {
            return $this->hasOne(get_class($identity), ['user_id' => $identity->primaryKey()]);
        }
        return null;
    }
}
