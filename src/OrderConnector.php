<?php

namespace Intredo\OrderConnector;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;

class OrderConnector
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $apiKey;

    public function __construct($apiKey, $endpoint)
    {
        $this->client = new Client([
            'base_uri' => $endpoint,
        ]);
        $this->apiKey = $apiKey;
    }

    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param Order $order
     * @param bool $sync
     * @return \GuzzleHttp\Promise\PromiseInterface|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendOrder(Order $order, $sync = true)
    {
        $data = $order->jsonSerialize();
        $data['shop_id'] = $this->apiKey;
        $data['apikey'] = $this->apiKey;

        $options = [
            RequestOptions::JSON => [$data],
            RequestOptions::ALLOW_REDIRECTS => [
                'max' => 5,
                // Allow POST to be redirected as POST without losing body
                'strict' => true,
                // Forbid dropping to insecure requests
                'protocols' => ['https'],
            ],
        ];

        $actionUrl = '/api/add_orders?t=' . time();
        if ($sync) {
            return $this->client->request('POST', $actionUrl, $options);
        } else {
            return $this->client->requestAsync('POST', $actionUrl, $options);
        }
    }

    /**
     * @param PatchOrder $orderPatch
     * @param bool $sync
     * @return \GuzzleHttp\Promise\PromiseInterface|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendOrderUpdate(PatchOrder $orderPatch, $sync = true)
    {
        $data = $orderPatch->jsonSerialize();
        $data['shop_id'] = $this->apiKey;
        $data['apikey'] = $this->apiKey;

        $options = [
            RequestOptions::JSON => [$data],
            RequestOptions::ALLOW_REDIRECTS => [
                'max' => 5,
                // Allow POST to be redirected as POST without losing body
                'strict' => true,
                // Forbid dropping to insecure requests
                'protocols' => ['https'],
            ],
        ];

        $actionUrl = '/api/add_order_patch?t=' . time();
        if ($sync) {
            return $this->client->request('PATCH', $actionUrl, $options);
        } else {
            return $this->client->requestAsync('PATCH', $actionUrl, $options);
        }
    }
}
