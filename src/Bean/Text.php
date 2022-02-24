<?php

declare(strict_types=1);

namespace DingdingNotice\Bean;


class Text extends Message
{
    private string $msgType = Type::TEXT;
    private array $atMobiles;
    private bool $isAtAll;
    private string $content;


    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        parent::__construct();
        $this->content = $this->initText($content);
        $this->atMobiles = array_values($this->config->getAtMobile());
        $this->isAtAll = $this->config->isAtAll();
    }

    public function initText(string $content): string
    {
        foreach ($this->config->getAtMobile() as $mobile) {
            if ($mobile && $mobile != '*') {
                $content .= "@{$mobile} ";
            }
        }

        return $content;
    }

    public function assembleRequestParams(): array
    {
        return [
            'msgtype' => $this->msgType,
            'text' => [
                'content' => $this->content,
            ],
            'at' => [
                'atMobiles' => $this->atMobiles,
                'isAtAll' => $this->isAtAll
            ],
        ];
    }
}