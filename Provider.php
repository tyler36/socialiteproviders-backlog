<?php

namespace SocialiteProviders\Backlog;

use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;
use SocialiteProviders\Manager\OAuth2\User;

class Provider extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'BACKLOG';

    const SPACE = '';

    /**
     * {@inheritdoc}
     */
    protected $scopes = ['basic'];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        $space = config('services.backlog.space');

        return $this->buildAuthUrlFromBase("https://${space}.backlog.jp/OAuth2AccessRequest.action", $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        $space = config('services.backlog.space');

        return "https://${space}.backlog.jp/api/v2/oauth2/token";
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $space = config('services.backlog.space');

        $response = $this->getHttpClient()->get("https://${space}.backlog.jp/api/v2/users/myself", [
            'headers' => [
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'       => $user['id'],
            'nickname' => $user['userId'],
            'name'     => $user['name'],
            'email'    => $user['mailAddress'],
            'locale'   => $user['lang'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
