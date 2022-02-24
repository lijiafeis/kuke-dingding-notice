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