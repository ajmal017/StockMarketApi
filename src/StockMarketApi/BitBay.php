<?php

namespace StockMarketApi;


class BitBay {

    public function orderbook() {
        $orderbookJson = file_get_contents('https://bitbay.net/API/Public/BTCPLN/orderbook.json');
        $orderbook = json_decode($orderbookJson);
        return $orderbook;
    }
}
