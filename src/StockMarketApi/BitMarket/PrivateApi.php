<?php

namespace StockMarketApi\BitMarket;

/**
 * BitBay private api
 */
class PrivateApi {

    //Public key:
    private $key;
    // Private key:
    private $secret;
    private $apiUrl = 'https://www.bitmarket.pl/api2/';

    public function setKey(string $key) {
        $this->key = $key;
    }

    public function setSecret(string $secret) {
        $this->secret = $secret;
    }

    function bitmarket_api($method = 'info', $params = array()) {

        $params["method"] = $method;
        $params["tonce"] = time();

        $post = http_build_query($params, "", "&");
        $sign = hash_hmac("sha512", $post, $this->secret);

        $headers = [
            "API-Key: " . $this->key,
            "API-Hash: " . $sign,
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $this->apiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $ret = curl_exec($curl);

        return json_decode($ret);
    }

    /**
     * Places offer at the stock market
     *
     * @param string $type             offer type bid/buy or ask/sell
     * @param string $currency         shortcut of main currency for offer (e.g. “BTC”)
     * @param float  $amount           quantity of main currency
     * @param string $payment_currency shortcut of currency used to pay for offer (e.g. “PLN”)
     * @param float  $rate             rate for offer
     */
    public function trade(
    string $type, string $currency, float $amount, string $paymentCurrency, float $rate
    ) {
        $params = [
            'type' => $type,
            'currency' => $currency,
            'amount' => $amount,
            'payment_currency' => $paymentCurrency,
            'rate' => $rate
        ];
        return $this->bitmarket_api('trade', $params);
    }

    /**
     * Transfers cryptocurrency to other wallet
     *
     * @param string $currency Cryptocurrency to transfer.
     * @param float  $quantity Amount of cryptocurrency, which will be transferred.
     * @param string $address  Wallet address of receiver
     */
    public function transfer(string $currency, float $quantity, string $address) {
        $params = [
            'currency' => $currency,
            'quantity' => $quantity,
            'address' => $address,
        ];
        return $this->bitmarket_api('transfer', $params);
    }

    /**
     * Withdraws money into bank account
     *
     * @param string  $currency Currency to withdraw (e.g. USD)
     * @param float   $quantity Amount of money to withdraw
     * @param string  $account  Account number on which money would be transferred
     * @param boolean $express: true/false
     * @param string  $bic      swift/bic number
     * */
    public function withdraw(float $amount, string $address, string $currency) {

        $params = [
            'amount' => $amount,
            'currency' => $currency,
            'address' => $address
        ];
        return $this->bitmarket_api('withdraw', $params);
    }

    /*
     * Returns information about account balances
     */

    public function info() {

        return $this->bitmarket_api('info');
    }

}
