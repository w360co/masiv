<?php
/**
 * Masiv Client Library for PHP
 *
 * @copyright Copyright (c) 2020 W360, Inc. (https://lotous.com.co)
 * @license   https://github.com/lotous/masiv/blob/master/LICENSE MIT License
 */

namespace W360\Masiv\Client\Credentials;

abstract class AbstractCredentials implements CredentialsInterface
{
    protected $credentials = array();

    public function offsetExists($offset)
    {
        return isset($this->credentials[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->credentials[$offset];
    }

    public function offsetSet($offset, $value)
    {
        throw $this->readOnlyException();
    }

    public function offsetUnset($offset)
    {
        throw $this->readOnlyException();
    }

    public function __get($name)
    {
        return $this->credentials[$name];
    }

    public function asArray()
    {
        return $this->credentials;
    }

    protected function readOnlyException()
    {
        return new \RuntimeException(sprintf(
            '%s is read only, cannot modify using array access.',
            get_class($this)
        ));
    }
}
