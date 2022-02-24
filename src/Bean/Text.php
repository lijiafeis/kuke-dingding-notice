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

    /**
     * @return string
     */
    public function getMsgType(): string
    {
        return $this->msgType;
    }

    /**
     * @param string $msgType
     */
    public function setMsgType(string $msgType): void
    {
        $this->msgType = $msgType;
    }

    /**
     * @return array
     */
    public function getAtMobiles(): array
    {
        return $this->atMobiles;
    }

    /**
     * @param array $atMobiles
     */
    public function setAtMobiles(array $atMobiles): void
    {
        $this->atMobiles = $atMobiles;
    }

    /**
     * @return bool
     */
    public function isAtAll(): bool
    {
        return $this->isAtAll;
    }

    /**
     * @param bool $isAtAll
     */
    public function setIsAtAll(bool $isAtAll): void
    {
        $this->isAtAll = $isAtAll;
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