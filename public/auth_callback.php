<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$shop = $_GET['shop'] ?? '';
$code = $_GET['code'] ?? '';
$api_key = $_ENV['SHOPIFY_API_KEY'];
$api_secret = $_ENV['SHOPIFY_API_SECRET'];

$token_url = "https://{$shop}/admin/oauth/access_token";
$response = (new GuzzleHttp\Client())->post($token_url, [
    'form_params' => [
        'client_id' => $api_key,
        'client_secret' => $api_secret,
        'code' => $code,
    ]
]);
$data = json_decode($response->getBody(), true);
$access_token = $data['access_token'] ?? '';

if ($access_token) {
    $envPath = __DIR__ . '/../.env';
    $env = file_get_contents($envPath);
    $env = preg_replace('/SHOPIFY_ACCESS_TOKEN=.*/', "SHOPIFY_ACCESS_TOKEN={$access_token}", $env);
    $env = preg_replace('/SHOPIFY_SHOP_DOMAIN=.*/', "SHOPIFY_SHOP_DOMAIN={$shop}", $env);
    file_put_contents($envPath, $env);
    header("Location: /public/admin.php");
    exit;
} else {
    echo "OAuth failed.";
} 