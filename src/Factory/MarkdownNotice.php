<?php

declare(strict_types=1);

namespace DingdingNotice\Factory;

use DingdingNotice\Bean\Message;
use DingdingNotice\Bean\Type;
use DingdingNotice\Exception\RequestException;
use DingdingNotice\Request\Request;
use GuzzleHttp\Exception\GuzzleException;

class MarkdownNotice extends AbstractNotice
{
    const Type = Type::MARKDOWN;
    /**
     * @param Message $message
     * @return bool
     * @throws RequestException
     * @throws GuzzleException
     */
    public function notice(Message $message): bool
    {
        $requestBody = [
            'msgtype' => self::Type,
            'markdown' => $message->initSendContent($this->config),
            'at' => ['atMobiles' => array_values($this->config->getAtMobile()), 'isAtAll' => $this->config->isAtAll()],
        ];
        return Request::requestDingDing($this->config, $requestBody);
    }
}