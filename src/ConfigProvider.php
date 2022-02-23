<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace DingdingNotice;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                Config::class => ConfigFactory::class,
            ],
            'commands' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for dingding_notice.',
                    'source' => __DIR__ . '/../publish/dingding_notice.php',
                    'destination' => BASE_PATH . '/config/autoload/dingding_notice.php',
                ],
            ],
        ];
    }
}
