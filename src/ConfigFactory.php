<?php

declare(strict_types=1);

namespace DingdingNotice;

use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

class ConfigFactory
{
    public function __invoke(ContainerInterface $container): Config
    {
        $config = $container->get(ConfigInterface::class);
        $instance = new Config();
        $instance->setEnable($config->get('dingding_notice.enable') ?? false);
        $instance->setNoticeUrl($config->get('dingding_notice.notice_url') ?? '');
        $instance->setSecret($config->get('dingding_notice.secret') ?? '');
        $instance->setIgnoreException($config->get('dingding_notice.ignore_exception') ?? []);
        $instance->setAtMobile($config->get('dingding_notice.at_mobile') ?? []);

        return $instance;
    }

}