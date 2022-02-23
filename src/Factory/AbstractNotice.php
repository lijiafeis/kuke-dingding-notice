<?php

namespace DingdingNotice\Factory;

use DingdingNotice\Bean\Message;
use DingdingNotice\Config;

abstract class AbstractNotice
{
    protected Config $config;

    public function __construct()
    {
        $container = \Hyperf\Utils\ApplicationContext::getContainer();
        $this->config = $container->get(Config::class);
    }

    abstract public function notice(Message $message);

}