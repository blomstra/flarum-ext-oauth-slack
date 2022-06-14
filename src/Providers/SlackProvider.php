<?php

namespace Blomstra\OAuthSlack\Providers;

use Chadhutchins\OAuth2\Client\Provider\Slack;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class SlackProvider extends Slack
{
    public function getBaseAuthorizationUrl()
    {
        return 'https://slack.com/openid/connect/authorize';
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://slack.com/api/openid.connect.token';
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
         return 'https://slack.com/api/openid.connect.userInfo';
    }

    protected function getDefaultScopes()
    {
        return [];
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['ok']) && $data['ok'] === false) {
            throw new IdentityProviderException($data['error'], null, $data);
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new SlackResourceOwner($response);
    }


    protected function prepareAccessTokenResponse(array $result)
    {
        $result = parent::prepareAccessTokenResponse($result);

        return [
            'access_token' => $result['access_token'],
            'resource_owner_id' => $result['id_token']
        ];
    }

    protected function getAuthorizationHeaders($token = null)
    {
        return ['Authorization' => 'Bearer ' . $token];
    }
}
