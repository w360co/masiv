<?php

use W360\Masiv\Client;


//example of sending an sms using an API key / secret
require_once '../vendor/autoload.php';

//create client with api key and secret
$client = new Client(new W360\Masiv\Client\Credentials\Basic('usuario@dominio.com', 'api_password'));

//send message using simple api params
$response = $client->sendMessage('51965876567, 573002111111', 'Esto es una prueba en PHP');

//array access provides response data
print_r($response);

