<?php

namespace StockMarketApi\BitBay;

/**
 * BitBay private api.
 *
 * @author miki
 */
class PrivateApi {

    private $key;
    private $secret;
    private $privateApiUrl = 'https://bitbay.net/API/Trading/tradingApi.php';

    public function setKey(string $key) {
        $this->key = $key;
    }

    public function setSecret(string $secret) {
        $this->secret = $secret;
    }

    private function doRequest($method, $params = array()) {

        $params["method"] = $method;
        $params["moment"] = time();

        $post = http_build_query($params, "", "&");
        $sign = hash_hmac("sha512", $post, $this->secret);
        $headers = array(
            "API-Key: " . $this->key,
            "API-Hash: " . $sign,
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $this->privateApiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $ret = curl_exec($curl);

        return json_decode($ret);
    }
    
    /**
     * Returns information about account balances
     */
    public function info() {
        return $this->doRequest('info');
    }

    /**
     * Places offer at the stock market
     * 
     * @param string $type            Offer type bid/buy or ask/sell
     * @param string $currency        Shortcut of main currency for offer (e.g. “BTC”)
     * @param float  $amount          Quantity of main currency
     * @param string $paymentCurrency Shortcut of currency used to pay for offer (e.g. “PLN”)
     * @param float  $rate            Rate for offer
     */

    public function trade(string $type, string $currency, float $amount, string $paymentCurrency, float $rate) {

        return $this->doRequest(
            'trade', 
            array(
                'type' => $type,
                'currency' => $currency,
                'amount' => $amount,
                'payment_currency' => $paymentCurrency,
                'rate' => $rate
            )
        );
    }
    
    /**
     * Transfers cryptocurrency to other wallet
     *
     * @param string $currency Cryptocurrency to transfer
     * @param float  $quantity Amount of cryptocurrency, which will be transferred
     * @param string $address  Wallet address of receiver
     * 
     */
    public function transfer(string $currency,float $quantity, string $address){
        
        return $this->doRequest(
            'transfer', 
            array(
                'currency' => $currency,
                'quantity' => $quantity,
                'address' => $address
            )
        );
    }
}
