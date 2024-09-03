<?php

/**
 * Masiv Client Library for PHP
 *
 * @copyright Copyright (c) 2020 W360, Inc. (https://lotous.com.co)
 * @license   https://github.com/lotous/masiv/blob/master/LICENSE MIT License
 */

namespace W360\Masiv\Facade;

use W360\Masiv\Client;
use Illuminate\Support\Facades\Facade;

class Masiv extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
