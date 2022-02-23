<?php

declare(strict_types=1);

namespace DingdingNotice\Factory;

use DingdingNotice\Bean\Type;

class NoticeFactory
{

    /**
     * @param string $type
     * @return MarkdownNotice|TextNotice|null
     */
    public static function getNotice(string $type)
    {
        switch ($type) {
            case Type::TEXT:
                $notice = new TextNotice();
                break;
            case Type::MARKDOWN:
                $notice = new MarkdownNotice();
                break;
            default:
                $notice = null;
        }

        return $notice;
    }
}