<?php
/**
 * Masiv Client Library for PHP
 *
 * @copyright Copyright (c) 2020 W360, Inc. (https://lotous.com.co)
 * @license   https://github.com/lotous/masiv/blob/master/LICENSE MIT License
 */

namespace W360\Masiv\Client\Credentials;

interface CredentialsInterface extends \ArrayAccess
{
    public function asArray();
}
