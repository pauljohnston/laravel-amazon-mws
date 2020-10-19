<?php

namespace Looxis\LaravelAmazonMWS\Tests;

use Looxis\LaravelAmazonMWS\MWSFeeds;
use Looxis\LaravelAmazonMWS\MWSOrders;
use Looxis\LaravelAmazonMWS\MWSProducts;
use Looxis\LaravelAmazonMWS\MWSService;
use Orchestra\Testbench\TestCase;

class MWSServiceTest extends TestCase
{
    /** @test */
    public function get_orders_service()
    {
        $mws = new MWSService;
        $this->assertInstanceOf(MWSOrders::class, $mws->orders());
    }

    /** @test */
    public function get_feeds_service()
    {
        $mws = new MWSService;
        $this->assertInstanceOf(MWSFeeds::class, $mws->feeds());
    }

    /** @test */
    public function get_products_service()
    {
        $mws = new MWSService;
        $this->assertInstanceOf(MWSProducts::class, $mws->feeds());
    }
}
