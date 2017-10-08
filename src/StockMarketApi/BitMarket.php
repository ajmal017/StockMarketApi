<?php

namespace StockMarketApi;

use StockMarketApi\Api;

class BitMarket{

    public function orderbook() {
        $orderbookJson = file_get_contents('https://www.bitmarket.pl/json/BTCPLN/orderbook.json');
        $orderbook = json_decode($orderbookJson);
        return $orderbook;
    }

}
