<?php

namespace Tests\StockMarketApi\BitMarket;


use PHPUnit\Framework\TestCase;
use StockMarketApi\BitMarket\PublicApi;

class PublicApiTest extends TestCase {

    private $api;
    
    protected function setUp()
    {
        $this->api = new PublicApi();
    }
    public function testOrderbook(){
        $ret = $this->api->orderbook();
        $this->assertEquals(true,property_exists($ret,'bids'));
        $this->assertEquals(true,property_exists($ret,'asks'));
        $this->assertEquals(true, is_array($ret->bids));
        $this->assertEquals(true, is_array($ret->asks));
        $this->assertEquals(true, is_float($ret->bids[0][0]));
        $this->assertEquals(true, is_float($ret->asks[0][0]));
        $this->assertEquals(true, is_float($ret->bids[0][1]));
        $this->assertEquals(true, is_float($ret->asks[0][1]));
    }
}
