<?php

namespace Braze;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Class BrazeUserData.
 *
 * @see https://www.braze.com/docs/api/interactive/#/User_Data
 */
class BrazeUserData
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
     * User Track Event.
     *
     * @throws GuzzleException
     *
     * @return mixed
     */
    public function trackEvents(array $options = [])
    {
        return $this->client->post(self::BASE_ENDPOINT.'/track/events', $options);
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
    public function addAlias(string $externalIds, string $aliasName, string $aliasLabel)
    {
        return $this->client->post(self::BASE_ENDPOINT.'/alias/new', [
            'user_aliases' => [
                [
                    'external_ids' => $externalIds,
                    'alias_name' => $aliasName,
                    'alias_label' => $aliasLabel,
                ],
            ],
        ]);
    }
}
