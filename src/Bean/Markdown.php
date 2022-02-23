<?php

declare(strict_types=1);

namespace DingdingNotice\Bean;

use DingdingNotice\Config;

class Markdown extends Message
{
    private string $subject;
    private string $content;

    /**
     * @param string $subject
     * @param string $content
     */
    public function __construct(string $subject, string $content)
    {
        $this->subject = $subject;
        $this->content = $content;
    }


    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
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
            'title' => $this->subject,
            'text' => $this->content,
        ];
    }


}