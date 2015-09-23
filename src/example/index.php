<?php

use GuzzleHttp\Client;

require 'vendor/autoload.php';

ini_set('display_errors', 1);

$loader = new Twig_Loader_Filesystem(__DIR__.'/views');

$twig = new Twig_Environment($loader, array(
    'cache' => __DIR__.'/cache',
));

$first = $twig->render('first.html.twig', array('name' => 'prophet'));

$body1 = $twig->render('page.html.twig', array('name' => 'prophet'));
$body2 = $twig->render('page.html.twig', array('name' => 'prophet'));
$body3 = $twig->render('page.html.twig', array('name' => 'prophet'));

$last = $twig->render('last.html.twig', array('name' => 'prophet'));

$client = new Client([
    'base_uri' => 'http://nginx',
    'timeout' => 2.0
]);

$request = new \GuzzleHttp\Psr7\Request('GET', '/');
$promise = $client->sendAsync($request)->then(function ($response) {
    echo 'I completed! ' . $response->getBody();
});

$promise->wait();
