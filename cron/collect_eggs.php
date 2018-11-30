<?php

include __DIR__.'/vendor/autoload.php';
use Guzzle\Http\Client;

// create our http client (Guzzle)
$http = new Client('http://coop.apps.symfonycasts.com', array(
    'request.options' => array(
        'exceptions' => false,
    )
));

//$accessToken = 'a29ae7f92a5e960c2fa6c79cfadc190e1aadc70a';
////$accessToken = 'abcd1234def67890';
//$request = $http->post('/api/158/eggs-collect');
//$request->addHeader('Authorization', 'Bearer '.$accessToken);
//$response = $request->send();
//echo $response->getBody();
//
//echo "\n\n";

// step1: request an access token
$request = $http->post('/token', null, array(
    'client_id'     => "Brent's Lazy CRON Job2",
    'client_secret' => 'f72bb6fbd3c776ebcb3c3a466d67e385',
    'grant_type'    => 'client_credentials',
));

// make a request to the token url
$response = $request->send();
$responseBody = $response->getBody(true);
//var_dump($responseBody);die;
$responseArr = json_decode($responseBody, true);
$accessToken = $responseArr['access_token'];


// step2: use the token to make an API request
$request = $http->post('/api/158/eggs-collect');
$request->addHeader('Authorization', 'Bearer '.$accessToken);
$response = $request->send();
echo $response->getBody();

echo "\n\n";