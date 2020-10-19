<?php

namespace Looxis\LaravelAmazonMWS;

class MWSService
{
    public function __construct(MWSClient $mwsClient = null)
    {
        $this->mwsClient = $mwsClient ?: new MWSClient();
    }

    public function orders()
    {
        return new MWSOrders($this->mwsClient);
    }

    public function products()
    {
        return new MWSProducts($this->mwsClient);
    }

    public function feeds()
    {
        return new MWSFeeds($this->mwsClient);
    }

    public function setMarketPlaces($countries)
    {
        $countries = is_array($countries) ? $countries : func_get_args();
        $this->mwsClient->setMarketPlaces($countries);
    }
}
