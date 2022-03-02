<?php

declare(strict_types=1);

namespace DingdingNotice;

use DingdingNotice\Bean\Markdown;
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
            $id = Coroutine::create(function () use ($message) {
                $message->requestDingDing();
            });
            if ($id === -1) {
                return false;
            }
        } catch (\Throwable $e) {
            return false;
        }
        return true;
    }

    public static function exceptionNotice(\Throwable $e): bool
    {
        $time = self::getMsecToMescdate();
        $subject = '报错了';
        $content = <<<INFO
{$e->getFile()}:{$e->getLine()}\n
**time**:{$time}\n
**message**:{$e->getMessage()}\n
**code**:{$e->getCode()}\n
**trace**:{$e->getTraceAsString()}
INFO;
        $markdown = new Markdown($subject, $content);
        return self::notice($markdown);
    }

    /**
     * 获取毫秒时间字符串
     * @return array|false|string|string[]
     */
    private static function getMsecToMescdate()
    {
        list($millisecond, $sec) = explode(' ', microtime());
        $millisecond =  (float)sprintf('%.0f', (floatval($millisecond) + floatval($sec)) * 1000);
        $millisecond = $millisecond * 0.001;
        $millisecond = sprintf("%01.3f", $millisecond);
        list($usec, $sec) = explode(".", (string)$millisecond);
        $sec = str_pad($sec, 3, "0", STR_PAD_RIGHT);
        $date = date("Y-m-d H:i:s.x", (int)$usec);
        return str_replace('x', $sec, $date);
    }

}
