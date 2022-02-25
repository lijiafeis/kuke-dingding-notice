<?php

declare(strict_types=1);

namespace DingdingNotice;

use DingdingNotice\Bean\Message;
use Hyperf\Utils\Coroutine;

class DingDingNotice
{
    public static function notice(Message $message): bool
    {
        try {
            $config = $message->getConfig();
            $config->verify();
            //判断开关是否打开
            if ($config->isEnable() === false) {
                return false;
            }
            //同步执行
            if ($config->isSync() === true) {
                $message->requestDingDing();
            } else {
                $id = Coroutine::create(function () use ($message) {
                    $message->requestDingDing();
                });
                if ($id === -1) {
                    return false;
                }
            }
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }
}