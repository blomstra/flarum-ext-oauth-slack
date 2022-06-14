<?php

namespace Blomstra\OAuthSlack\Providers;

use Flarum\Forum\Auth\Registration;
use FoF\OAuth\Provider;
use League\OAuth2\Client\Provider\AbstractProvider;
use Chadhutchins\OAuth2\Client\Provider\Slack as SlackProvider;

class Slack extends Provider
{
    /**
     * @var SlackProvider
     */
    protected $provider;

    public function name(): string
    {
        return 'slack';
    }

    public function link(): string
    {
        return 'https://api.slack.com/authentication/sign-in-with-slack';
    }

    public function fields(): array
    {
        return [
            'client_id'     => 'required',
            'client_secret' => 'required',
        ];
    }

    public function provider(string $redirectUri): AbstractProvider
    {
        return $this->provider = new SlackProvider([
            'clientId'     => $this->getSetting('client_id'),
            'clientSecret' => $this->getSetting('client_secret'),
            'redirectUri'  => $redirectUri,
        ]);
    }

    public function suggestions(Registration $registration, $user, string $token)
    {
        $this->verifyEmail($email = $user->getEmail());

        $registration
            ->provideTrustedEmail($email)
            ->setPayload($user->toArray());
    }
}
