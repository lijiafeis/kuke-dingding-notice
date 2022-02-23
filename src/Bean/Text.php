<?php

declare(strict_types=1);

namespace DingdingNotice\Bean;

use DingdingNotice\Config;

class Text extends Message
{
    private string $content;

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }


    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }


    public function initSendContent(Config $config): array
    {
        foreach ($config->getAtMobile() as $mobile) {
            if ($mobile && $mobile != '*') {
                $this->content .= "@{$mobile} ";
            }
        }

        return [
            'content' => $this->content
        ];
    }
}