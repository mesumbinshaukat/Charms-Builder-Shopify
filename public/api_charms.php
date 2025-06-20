<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
require_once __DIR__ . '/../src/ShopifyClient.php';

header('Content-Type: application/json');
$client = new ShopifyClient();
echo json_encode($client->getCharms()); 