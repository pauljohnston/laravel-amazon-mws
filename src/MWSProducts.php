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

        return $this->parseResponse($response, $action.'Result');
    }

    public function getByTypeId($params = [])
    {
        $action = 'GetMatchingProductForId';

        $response = $this->client->post($action, '/Products/'.self::VERSION, self::VERSION, $params);

        return $this->parseResponse($response, $action.'Result');
    }

    protected function parseResponse($response, $result)
    {
        $requestId = data_get($response, 'ResponseMetadata.RequestId');
        $data = data_get($response, $result.'.Products.Product');
        $attributes = $data->AttributeSets->children('ns2', true)->ItemAttributes;

        return $this->xmlToArray([
            'request_id' => $requestId,
            'data' => $data,
            'attributes' => $attributes,
        ]);
    }

    protected function xmlToArray($xml)
    {
        $array = json_encode($xml);
        return json_decode($array, true);
    }
}
