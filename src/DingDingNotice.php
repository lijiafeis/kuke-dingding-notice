<?php

declare(strict_types=1);

namespace DingdingNotice;

use DingdingNotice\Bean\Markdown;
use DingdingNotice\Bean\Text;
use DingdingNotice\Bean\Type;
use DingdingNotice\Handler\NoticeHandler;

class DingDingNotice
{
    public static function text(string $content): bool
    {
        $message = new Text($content);
        return (new NoticeHandler())->noticeHandler(Type::TEXT, $message);
    }

    public static function markdown(string $subject, string $content): bool
    {
        $message = new Markdown($subject, $content);
        return (new NoticeHandler())->noticeHandler(Type::MARKDOWN, $message);
    }
}