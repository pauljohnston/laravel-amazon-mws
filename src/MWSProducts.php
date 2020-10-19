<?php

namespace Looxis\LaravelAmazonMWS;

class MWSProducts
{
    const VERSION = '2011-10-01';

    protected $client;
    protected $content;
    protected $type;

    public function __construct(MWSClient $client)
    {
        $this->client = $client;
    }

    public function list($params = [])
    {
        $action = 'ListMatchingProducts';

        $response = $this->client->post($action, '/Products/'.self::VERSION, self::VERSION, $params);

        dd($response);

        return $this->parseResponse($response, $action.'Result', 'Products.Product.AttributeSets');
    }

    protected function parseResponse($response)
    {
        $requestId = data_get($response, 'ResponseMetadata.RequestId');
        $feed = data_get($response, 'ListMatchingProductsResult.Products.Product');

        return [
            'request_id' => $requestId,
            'data' => $feed,
        ];
    }
}
