<?php
/**
 * Masiv Client Library for PHP
 *
 * @copyright Copyright (c) 2020 W360, Inc. (https://lotous.com.co)
 * @license   https://github.com/lotous/masiv/blob/master/LICENSE MIT License
 */

namespace W360\Masiv\Client\Credentials;

/**
 * Class Basic
 * Read-only container for api key and secret.
 */
class Basic extends AbstractCredentials implements CredentialsInterface
{
    /**
     * Create a credential set with an API key and secret.
     *
     * @param string $key
     * @param string $secret
     */
    public function __construct($key, $secret)
    {
        $this->credentials['api_key'] = $key;
        $this->credentials['api_secret'] = $secret;
    }
}
