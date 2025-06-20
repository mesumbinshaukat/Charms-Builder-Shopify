<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$shop = $_GET['shop'] ?? '';
$api_key = $_ENV['SHOPIFY_API_KEY'];
$scopes = 'read_products,write_orders';
$redirect_uri = $_ENV['NGROK_URL'] . '/public/auth_callback.php';

$install_url = "https://{$shop}/admin/oauth/authorize?client_id={$api_key}&scope={$scopes}&redirect_uri={$redirect_uri}";
header("Location: $install_url");
exit; 