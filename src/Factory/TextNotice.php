<?php

declare(strict_types=1);

namespace DingdingNotice\Factory;

use DingdingNotice\Bean\Message;
use DingdingNotice\Bean\Type;
use DingdingNotice\Exception\RequestException;
use DingdingNotice\Request\Request;
use GuzzleHttp\Exception\GuzzleException;

class TextNotice extends AbstractNotice
{
    const Type = Type::TEXT;

    /**
     * @param Message $message
     * @return bool
     * @throws RequestException
     * @throws GuzzleException
     */
    public function notice(Message $message): bool
    {
        $body = [
            'msgtype' => self::Type,
            'text' => $message->initSendContent($this->config),
            'at' => ['atMobiles' => array_values($this->config->getAtMobile()), 'isAtAll' => $this->config->isAtAll()],
        ];
        return Request::requestDingDing($this->config, $body);
    }
}