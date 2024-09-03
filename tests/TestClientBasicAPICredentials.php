<?php

namespace W360\Masiv\Tests;

use W360\Masiv\Client;
use W360\Masiv\Client\Credentials\Basic;

class TestClientBasicAPICredentials extends AbstractTestCase
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
     * @throws \ReflectionException
     */
    public function testClientCreatedWithBasicAPICredentials()
    {
        $client = app(Client::class);
        $credentialsObject = $this->getClassProperty(Client::class, 'credentials', $client);
        $credentialsArray = $this->getClassProperty(Basic::class, 'credentials', $credentialsObject);

        $this->assertInstanceOf(Basic::class, $credentialsObject);
        $this->assertEquals(['api_key' => 'my_api_key', 'api_secret' => 'my_secret'], $credentialsArray);
    }
}
