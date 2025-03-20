<?php

namespace App\Logger;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Monolog\LogRecord;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TelegramLogHandler extends AbstractProcessingHandler
{
    private string $botToken;
    private string $chatId;
    private HttpClientInterface $httpClient;

    public function __construct(
        HttpClientInterface $httpClient,
        string $botToken,
        string $chatId,
        int $level = Logger::ERROR,
        bool $bubble = true
    ) {
        parent::__construct($level, $bubble);
        $this->httpClient = $httpClient;
        $this->botToken = $botToken;
        $this->chatId = $chatId;
    }

    protected function write(LogRecord $record): void
    {
        $message = sprintf(
            "*%s*\n\n%s",
            strtoupper($record->level->getName()),
            $record->message
        );

        $this->httpClient->request('POST', "https://api.telegram.org/bot{$this->botToken}/sendMessage", [
            'json' => [
                'chat_id' => $this->chatId,
                'text' => $message,
            ],
        ]);
    }
}
