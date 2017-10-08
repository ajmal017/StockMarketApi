<?php

namespace StockMarketApi;


class Bitbay {

    public function orderbook() {
        $orderbookJson = file_get_contents('https://bitbay.net/API/Public/BTCPLN/orderbook.json');
        $orderbook = json_decode($orderbookJson);
        return $orderbook;
    }
}
