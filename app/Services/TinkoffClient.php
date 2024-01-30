<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;


class TinkoffClient
{
    private string $terminalKey;
    private string $secretKey;
    private string $apiUrl;

    private const METHOD_INIT = 'init';
    private const METHOD_GET_STATE = 'GetState';
    private array $headers = ['Content-Type' => 'application/json'];

    public function __construct(string $terminalKey, string $secretKey, string $apiUrl)
    {
        $this->terminalKey = $terminalKey;
        $this->secretKey = $secretKey;
        $this->apiUrl = $apiUrl;
    }

    public function init(string $orderId, int $amount, string $successURL, array $params)
    {
        $data = [
            'TerminalKey' => $this->terminalKey,
            'Amount' => $amount,
            'OrderId' => $orderId,
            'Token' => 'token',
            'Recurrent' => 'Y',
            'PayType' => 'O',
            'Language' => 'ru',
            'SuccessURL' => $successURL,
            'FailURL' => $params['failUrl']
        ];

        return $this->execute(self::METHOD_INIT, $data);

    }

    public function getState(string $paymentId)
    {
        $data = [
            'TerminalKey' => $this->terminalKey,
            'PaymentId' => $paymentId,
            'Token' => 'token',
        ];
        return $this->execute(self::METHOD_GET_STATE, $data);
    }

    private function execute(string $method, array $data)
    {
        $response = Http::withHeaders($this->headers)
            ->post($this->apiUrl . $method, $data);

        $this->parseResponse($response);

    }

    private function parseResponse(\http\Client\Response $response)
    {
        //TODO посмотреть что парсить
        return json_decode($response, true);
    }
}
