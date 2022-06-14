<?php

/*
 * This file is part of blomstra/oauth-slack.
 *
 * Copyright (c) 2022 Team Blomstra.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Blomstra\OAuthSlack\Providers;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class SlackProvider extends AbstractProvider
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
            'access_token'      => $result['access_token'],
            'resource_owner_id' => $result['id_token'],
        ];
    }

    protected function getAuthorizationHeaders($token = null)
    {
        return ['Authorization' => 'Bearer '.$token];
    }
}
