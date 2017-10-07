<?php

namespace StockMarketApi;

class Api {

    protected $page = null;

    public function getUrl() {
        return $this->url;
    }
    public function load($page) {
        $this->page = json_decode($page);
    }
    public function getOrderBook() {
        return $this->page;
    }
    public function najlepszaOfertaBid() {
        return $this->getOrderBook()->bids[0];
    }

    public function najlepszaOfertaAsk() {
        return $this->getOrderBook()->asks[0];
    }

}
