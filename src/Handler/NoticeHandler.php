<?php

declare(strict_types=1);

namespace DingdingNotice\Handler;

use DingdingNotice\Bean\Message;
use DingdingNotice\Exception\TypeNotFoundException;
use DingdingNotice\Factory\NoticeFactory;
use DingdingNotice\Factory\AbstractNotice;

class NoticeHandler
{
    /**
     * @throws TypeNotFoundException
     */
    public function noticeHandler($type, Message $message): bool
    {
        /** @var AbstractNotice $notice */
        $notice = NoticeFactory::getNotice($type);
        if ($notice === null) {
            throw new TypeNotFoundException('type not found');
        }
        return $notice->notice($message);
    }

}