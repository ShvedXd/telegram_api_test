<?php

namespace ShvedXd\TelegramApiTest;

use GuzzleHttp\Client;
final class TelegramTestApi
{

    const TELEGRAM_API_URI = 'https://api.telegram.org/bot';
    private Client $client;
    public function __construct(string $botToken)
    {
        $this->client = new Client([
            'base_uri' => self::TELEGRAM_API_URI . $botToken . '/',
        ]);
    }

    public function sendMessage(string $chatId, string $message, string $parse_mode = 'HTML'): void
    {
        $this->client->post('sendMessage', [
            'query' => ['chat_id' => $chatId, 'parse_mode' => $parse_mode],
            'json' => ['text' => $message]
        ]);
    }

    public function getUpdates(): array
    {
        $response = $this->client->get('getUpdates');

        $parsedResponse = json_decode($response->getBody()->getContents(),true);

        return array_map(function ($responseResult) {
            $message = $responseResult['message'];
            return [
                'text' => $message['text'],
                'from' => $message['from']['first_name'],
                'chat_id' => $message['chat']['id'],
            ];
        }, $parsedResponse['result']);
    }
}