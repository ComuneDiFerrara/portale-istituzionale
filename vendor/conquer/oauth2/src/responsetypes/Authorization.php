<?php
/**
 */

namespace conquer\oauth2\responsetypes;

use conquer\oauth2\models\AuthorizationCode;
use conquer\oauth2\BaseModel;

/**
 */
class Authorization extends BaseModel
{
    /**
     * Value MUST be set to "code".
     * @var string
     */
    public $response_type;
    /**
     * Client Identifier
     * @var string
     */
    public $client_id;
    /**
     * Redirection Endpoint
     * @var string
     */
    public $redirect_uri;
    /**
     * Access Token Scope
     * @var string
     */
    public $scope;
    /**
     * Cross-Site Request Forgery
     * @var string
     */
    public $state;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['response_type', 'client_id'], 'required'],
            ['response_type', 'required', 'requiredValue' => 'code'],
            [['client_id'], 'string', 'max' => 80],
            [['state'], 'string', 'max' => 255],
            [['redirect_uri'], 'url'],
            [['client_id'], 'validateClientId'],
            [['redirect_uri'], 'validateRedirectUri'],
            [['scope'], 'validateScope'],
        ];
    }

    /**
     * @return array
     * @throws \conquer\oauth2\Exception
     * @throws \yii\base\Exception
     */
    public function getResponseData()
    {
        $authCode = AuthorizationCode::createAuthorizationCode([
            'client_id' => $this->client_id,
            'user_id' => \Yii::$app->user->id,
            'expires' => $this->authCodeLifetime + time(),
            'scope' => $this->scope,
            'redirect_uri' => $this->redirect_uri
        ]);

        $query = [
            'code' => $authCode->authorization_code,
        ];

        if (isset($this->state)) {
            $query['state'] = $this->state;
        }

        return [
            'query' => http_build_query($query),
        ];
    }
}
