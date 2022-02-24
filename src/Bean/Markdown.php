<?php

declare(strict_types=1);

namespace DingdingNotice\Bean;


class Markdown extends Message
{
    private string $msgType = Type::MARKDOWN;
    private string $title;
    private string $text;
    private array $atMobiles;
    private bool $isAtAll;

    /**
     * @param string $subject
     * @param string $content
     */
    public function __construct(string $subject, string $content)
    {
        parent::__construct();
        $this->title = $subject;
        $this->text = $this->initText($content);
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
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



    public function initText(string $text): string
    {
        foreach ($this->config->getAtMobile() as $mobile) {
            if ($mobile && $mobile != '*') {
                $text .= "@{$mobile} ";
            }
        }

        return $text;
    }

    public function assembleRequestParams(): array
    {
        return [
                'msgtype' => $this->msgType,
                'markdown' => [
                    'title' => $this->title,
                    'text' => $this->text,
                ],
                'at' => [
                    'atMobiles' => $this->atMobiles,
                    'isAtAll' => $this->isAtAll,
                ],
        ];
    }


}