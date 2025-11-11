<?php
require 'vendor/autoload.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

Flight::route('/', function(){
    echo "Hello, FlightPHP!";
});

Flight::start();
?>
