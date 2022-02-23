<?php

declare(strict_types=1);

namespace DingdingNotice\Bean;

use DingdingNotice\Config;

abstract class Message
{

    abstract public function initSendContent(Config $config);
}