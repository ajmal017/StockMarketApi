<?php

namespace StockMarketApi\BitBay;

class PublicApi {

    private $baseCurrency = 'PLN';
    private $comodityCurrency = 'BTC';

    public function setBaseCurrency($baseCurrency) {
        $this->baseCurrency = $baseCurrency;
    }
    public function setComodityCurrency($comodityCurrency) {
        $this->comodityCurrency = $comodityCurrency;
    }
    public function orderbook() {
        $orderbookJson = file_get_contents('https://bitbay.net/API/Public/'.$this->comodityCurrency. $this->baseCurrency . '/orderbook.json');
        $orderbook = json_decode($orderbookJson);
        return $orderbook;
    }

}
