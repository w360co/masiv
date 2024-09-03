<?php

namespace W360\Masiv\Tests;

use Orchestra\Testbench\TestCase;
use W360\Masiv\MasivServiceProvider;
use W360\Masiv\Client;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @param $app
     * @return string[]
     */
    protected function getPackageProviders($app)
    {
        return [
            MasivServiceProvider::class,
        ];
    }

    /**
     * @param $app
     * @return string[]
     */
    protected function getPackageAliases($app)
    {
        return [
            'Masiv' => \W360\Masiv\Facade\Masiv::class,
        ];
    }

    /**
     * @param $class
     * @param $property
     * @param $object
     * @return mixed
     * @throws \ReflectionException
     */
    public function getClassProperty($class, $property, $object)
    {
        $reflectionClass = new \ReflectionClass($class);
        $refProperty = $reflectionClass->getProperty($property);
        $refProperty->setAccessible(true);

        return $refProperty->getValue($object);
    }

    /**
     * @return array[]
     */
    public function classNameProvider()
    {
        return [
            [Client::class]
        ];
    }
}
