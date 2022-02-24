<?php

declare(strict_types=1);

namespace DingdingNotice;

use DingdingNotice\Bean\Link;
use DingdingNotice\Bean\Markdown;
use DingdingNotice\Bean\Text;

class DingDingNotice
{
    public static function text(string $content): bool
    {
        $message = new Text($content);
        return $message->requestDingDing();
    }

    public static function markdown(string $subject, string $content): bool
    {
        $message = new Markdown($subject, $content);
        return $message->requestDingDing();
    }
}