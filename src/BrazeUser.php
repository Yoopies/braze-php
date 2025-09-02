<?php

namespace Braze;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class BrazeUser.
 *
 * @see https://www.braze.com/docs/api/interactive/#/User_Data
 */
class BrazeUser
{
    const BASE_ENDPOINT = 'users';

    /** @var BrazeClient */
    private $client;

    public function __construct(BrazeClient $client)
    {
        $this->client = $client;
    }

    /**
     * User Track.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function track(array $options = [])
    {
        return $this->client->post(self::BASE_ENDPOINT.'/track', $options);
    }

    /**
     * Identify User.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function identify(array $options = [])
    {
        return $this->client->post(self::BASE_ENDPOINT.'/track/identify', $options);
    }

    /**
     * Search Calls.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function delete(array $options = [])
    {
        return $this->client->post(self::BASE_ENDPOINT.'/delete', $options);
    }

    /**
     * Create a new user alias for an existing identified user.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function addAlias(string $externalId, string $aliasName, string $aliasLabel)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/alias/new', [
            'user_aliases' => [
                [
                    'external_id' => $externalId,
                    'alias_name' => $aliasName,
                    'alias_label' => $aliasLabel,
                ],
            ],
        ]);
    }

    /**
     * Update existing user alias.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function updateAlias(string $aliasLabel, string $oldAliasName, string $newAliasName)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/alias/new', [
            'alias_updates' => [
                [
                    'alias_label' => $aliasLabel,
                    'old_alias_name' => $oldAliasName,
                    'new_alias_name' => $newAliasName,
                ],
            ],
        ]);
    }
}
