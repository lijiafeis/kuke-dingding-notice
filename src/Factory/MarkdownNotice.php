<?php

declare(strict_types=1);

namespace DingdingNotice\Factory;

use DingdingNotice\Bean\Message;
use DingdingNotice\Bean\Type;

class MarkdownNotice extends AbstractNotice
{
    public function notice(Message $message): bool
    {
        $this->requestDingDing([
            'msgtype' => Type::MARKDOWN,
            'markdown' => $message->initSendContent($this->config),
            'at' => ['atMobiles' => $this->config->getAtMobile(), 'isAtAll' => $this->config->isAtAll()],
        ]);
        return true;
    }
}