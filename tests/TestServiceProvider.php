<?php

namespace W360\Masiv\Tests;

use W360\Masiv\Client;

class TestServiceProvider extends AbstractTestCase
{
    /**
     * @param $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('masiv.api_key', 'my_api_key');
        $app['config']->set('masiv.api_secret', 'my_secret');
    }

    /**
     * @return void
     */
    public function testClientResolutionFromContainer()
    {
        $className = Client::class; // Asigna la clase que deseas resolver aquí
        $client = app($className);

        $this->assertInstanceOf($className, $client);
    }
}
