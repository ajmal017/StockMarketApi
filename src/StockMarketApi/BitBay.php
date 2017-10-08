<?php

namespace StockMarketApi;

class BitBay {

    private $baseCurrency = 'PLN';

    public function setBaseCurrency($baseCurrency) {
        $this->baseCurrency = $baseCurrency;
    }

    public function orderbook() {
        $orderbookJson = file_get_contents('https://bitbay.net/API/Public/BTC' . $this->baseCurrency . '/orderbook.json');
        $orderbook = json_decode($orderbookJson);
        return $orderbook;
    }

}
