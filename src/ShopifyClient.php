<?php
class ShopifyClient {
    private $access_token;
    private $shop_domain;

    public function __construct() {
        $this->access_token = getenv('SHOPIFY_ACCESS_TOKEN');
        $this->shop_domain = getenv('SHOPIFY_SHOP_DOMAIN');
    }

    public function graphql($query, $variables = []) {
        $client = new \GuzzleHttp\Client();
        $response = $client->post("https://{$this->shop_domain}/admin/api/2025-01/graphql.json", [
            'headers' => [
                'X-Shopify-Access-Token' => $this->access_token,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode(['query' => $query, 'variables' => $variables])
        ]);
        return json_decode($response->getBody(), true);
    }

    public function getCharms() {
        $query = <<<GQL
        {
          products(first: 100, query: "tag:charm") {
            edges {
              node {
                id
                title
                description
                images(first: 5) { edges { node { src } } }
                variants(first: 5) {
                  edges {
                    node {
                      id
                      title
                      price
                      inventoryQuantity
                    }
                  }
                }
              }
            }
          }
        }
        GQL;
        $result = $this->graphql($query);
        return $result['data']['products']['edges'] ?? [];
    }
} 