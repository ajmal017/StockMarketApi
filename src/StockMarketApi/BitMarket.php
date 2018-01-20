<?php

namespace StockMarketApi;

use StockMarketApi\Api;

class BitMarket{
    
    private $baseCurrency = 'USD';

    public function setBaseCurrency($baseCurrency) {
        $this->baseCurrency = $baseCurrency;
    }
    
    public function orderbook() {
        $orderbookJson = file_get_contents('https://www.bitmarket.pl/json/BTC' . $this->baseCurrency . '/orderbook.json');
        $orderbook = json_decode($orderbookJson);
        return $orderbook;
    }

}
