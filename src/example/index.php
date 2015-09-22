<?php

use Guzzle\Http\Client;

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

new Client();

echo 'done';
